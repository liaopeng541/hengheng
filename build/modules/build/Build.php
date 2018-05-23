<?php

namespace build\modules\build;

use Yii;
use yii\base\BootstrapInterface;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;


class Build extends \yii\base\Module implements BootstrapInterface
{


    public $controllerNamespace = 'build\modules\build\controllers';
    public $allowedIPs = ['127.0.0.1', '::1'];
    public $generators = [];
    public $newFileMode = 0666;
    public $newDirMode = 0777;


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id, 'route' => $this->id . '/default/index'],
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<id:\w+>', 'route' => $this->id . '/default/view'],
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>', 'route' => $this->id . '/<controller>/<action>'],
        ], false);

    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app instanceof \yii\web\Application && !$this->checkAccess()) {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }

        foreach (array_merge($this->coreGenerators(), $this->generators) as $id => $config) {
            if (is_object($config)) {
                $this->generators[$id] = $config;
            } else {
                $this->generators[$id] = Yii::createObject($config);
            }
        }

        $this->resetGlobalSettings();

        return true;
    }

    protected function resetGlobalSettings()
    {
        if (Yii::$app instanceof \yii\web\Application) {
            Yii::$app->assetManager->bundles = [];
        }
    }

    protected function checkAccess()
    {
        $ip = Yii::$app->getRequest()->getUserIP();
        foreach ($this->allowedIPs as $filter) {
            if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                return true;
            }
        }
        Yii::warning('Access to Gii is denied due to IP address restriction. The requested IP is ' . $ip, __METHOD__);

        return false;
    }

    protected function coreGenerators()
    {
        return [
            'model' => ['class' => 'build\lpii\model\Generator'],
            'crud' => ['class' => 'build\lpii\crud\Generator'],
            'treecrud' => ['class' => 'build\lpii\treecrud\Generator'],
            'config' => ['class' => 'build\lpii\config\Generator'],
            'controller' => ['class' => 'build\lpii\controller\Generator'],
            'form' => ['class' => 'build\lpii\form\Generator'],
            'module' => ['class' => 'build\lpii\module\Generator'],
            'extension' => ['class' => 'build\lpii\extension\Generator'],
        ];
    }

    protected function defaultVersion()
    {
        $packageInfo = Json::decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'composer.json'));
        $extensionName = $packageInfo['name'];
        if (isset(Yii::$app->extensions[$extensionName])) {
            return Yii::$app->extensions[$extensionName]['version'];
        }
        return parent::defaultVersion();
    }
}
