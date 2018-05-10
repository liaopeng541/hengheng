<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $properties array list of properties (property => [type, name. comment]) */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;
<?
$tables=$generator->show['table'];
if($tables){
foreach ($tables as $val)
{
    if($val['f_key'])
    {
        $k_arr=explode(':',$val['f_key']);
        if($k_arr[0]=='key')
        {
            $mc=$generator->L_T($k_arr[1],"_");
            echo 'use common\\models\\'.$mc.";\n";
        }

    }
}}
?>
use Yii;

/**
 * This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
 *
<?php foreach ($properties as $property => $data): ?>
 * @property <?= "{$data['type']} \${$property}"  . ($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{

    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }
<?php if ($generator->db !== 'db'): ?>
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>
    public function rules()
    {
        return [<?= empty($rules) ? '' : ("\n            " . implode(",\n            ", $rules) . ",\n        ") ?>];
    }
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
            <?= "'$name' => " . (isset($generator->show)?"'".$generator->show['table'][$name]['show_name']."'":$generator->generateString($label)) . ",\n" ?>
<?php endforeach; ?>
        ];
    }

<?if($tables){
        foreach ($tables as $key=>$val)
        {
            if($val['f_key'])
            {
                $k_arr=explode(':',$val['f_key']);
                if($k_arr[0]=='key')
                {
                    $o_arr=explode(">",$k_arr[2]);
                    $class_name=$generator->L_T($k_arr[1],"_");
                    $table_name=ucfirst($k_arr[1]."_".$o_arr[0]);
                    echo '      public function get'.$table_name."(){\n";
                    if($k_arr[4]=="一对一")
                    {
                        //return $this->hasOne(HhWorker::className(),["id"=>"setorder_worker"]);
                        echo '          return $this->hasOne('.$class_name.'::className(),["'.$o_arr[0].'"=>"'.$key.'"]);'."\n";
                    }else{
                        echo '          return $this->hasMany('.$class_name.'::className(),["'.$key.'"=>"'.$o_arr[0].'"]);'."\n";

                    }
                    echo "      }\n";
                }else{

                    echo '      public static function get'.$key."text(\$index){\n";
                    $t_arr=explode(',',$k_arr[1]);
                    echo '              $text=['."\n";
                    foreach ($t_arr as $v)
                    {
                        $kv=str_replace('=','"=>"',$v);
                        echo '                  "'.$kv.'",'."\n";
                    }
                    echo '              ];'."\n";
                    echo '              return isset($text[strval($index)])?$text[strval($index)]:"";'."\n";
                    echo "      }\n";
                }

            }
        }}
?>
<?php foreach ($relations as $name => $relation): ?>
    public function get<?= $name ?>()
    {
        <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>
<?php if ($queryClassName): ?>
<?php
    $queryClassFullName = ($generator->ns === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
    echo "\n";
?>
    /**
     * @inheritdoc
     * @return <?= $queryClassFullName ?> the active query used by this AR class.
     */
    public static function find()
    {
        return new <?= $queryClassFullName ?>(get_called_class());
    }
<?php endif; ?>

    public function giishow()
    {
<?php if ($generator->show){ ?>
        return <?=var_export($generator->show,true)?>;
<?php }else{ ?>
        return null;
<?php } ?>
    }

}
