<?php
$className = $generator->moduleClass;
$pos = strrpos($className, '\\');
$ns = ltrim(substr($className, 0, $pos), '\\');
$className = substr($className, $pos + 1);

echo "<?php\n";
?>

namespace <?= $ns ?>;

/**
 * <?= $generator->moduleID ?> 模块
 */
class <?= $className ?> extends \yii\base\Module
{
    public $controllerNamespace = '<?= $generator->getControllerNamespace() ?>';

    public function init()
    {
        parent::init();
    }
}
