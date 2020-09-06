<?php

require __DIR__."/../vendor/autoload.php";



/**
 * Class Phone
 *
 * @MyControllerAnnotion(
 *
 *     prefix="v1/api"
 * )
 *
 */
class Phone
{
    public $version;

    public function call()
    {
        echo "is calling...";
    }


}



/**
 * 假设是个自定义的注解类
 * Class MyControllerAnnotion
 *
 * @Annotation
 */
class MyControllerAnnotion
{
    public $prefix;
}


$class = new ReflectionClass(Phone::class);
// 第一步获取这个类的注释
$comment = $class->getDocComment();
print_r($comment);

echo PHP_EOL;

// 第二部就要针把这个注释中的注解解析出来了，主要是正则匹配啥的了
// 这个还真是有点复杂，我们使用人家的包来解析
$reader = new \Doctrine\Common\Annotations\AnnotationReader();
$annitons = $reader->getClassAnnotation($class, MyControllerAnnotion::class);
print_r($annitons);
echo PHP_EOL;


// 第三部摘出来注解之后，跟当前类进行关联就行了，啥时候用取出来就可以了
$container[$class->getName()]['class'][] = $annitons;

print_r($container);



