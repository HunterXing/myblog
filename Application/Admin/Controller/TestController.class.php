<?php
/**
 * Created by IntelliJ IDEA.
 * User: xingheng
 * Date: 2018/10/4
 * Time: 18:15
 * @Last Modified time: @CreatedDate
 */
//声明命名空间
namespace Admin\Controller;

//引入父类控制器
use Think\Controller;
use Think\Verify;

//继承父类控制器
class TestController extends Controller
{
    public function test()
    {
        //echo "后台";
        $this->display();
    }

    public function test1()
    {
        echo U('index');
    }

    public function test2()
    {
        echo U('Home/Index/index');
    }

    public function test3()
    {
        echo U('Index/index', array('id' => 1, 'name' => 'jack'));
    }

    public function test4()
    {
        $this->success('跳转成功', U('Home/Index/index'), 3);
    }

    public function test5()
    {
        $this->error('跳转失败', U('Home/Index/index'), 3);
    }

    //变量分配初级
    public function test6()
    {
        $var = date('Y-m-d H:i:s', time());
        $this->assign('var', $var);
        $this->display();
    }

    //模板常量
    public function test7()
    {
        $this->display();
    }

    //数组
    public function test8()
    {
        //一维数组
        $array = array(
            // '' => , 
            '西游记', '红楼梦', '三国演义', '水浒传'
        );

        //二维数组
        $array2 = array(
            array('孙悟空', '唐三藏', '沙悟净'),
            array('薛宝钗', '林黛玉', '贾宝玉'),
            array('林冲', '武松', '宋江'),
            array('刘备', '关羽', '张飞'),
        );

        //变量的分配
        $this->assign('array', $array);
        $this->assign('array2', $array2);
        $this->display();
    }

    //变量分配
    public function test9()
    {
        //实例化Student对象
        $stu = new Student();
        $stu->id = 1;
        $stu->name = '张三';
        $stu->age = 18;
        // dump($stu);

        $this->assign('stu', $stu);
        $this->display();

    }

    //系统变量
    public function test10()
    {
        //展示模板
        $this->display();
    }

    //视图中使用函数
    public function test11()
    {
        //定义时间戳
        $time = time();

        $str = 'AfgaewEFsgfS';
        //传递给模板
        $this->assign('time', $time);
        $this->assign('str', $str);
        $this->display();
    }

    //默认
    public function test12()
    {
        $significant = '十步杀一人，千里不留行';
        $this->assign('significant', $significant);
        $this->display();
    }

    public function body()
    {

        $this->display();
    }

    //数组遍历
    public function test14()
    {
        //一维数组
        $array = array(
            // '' => , 
            '西游记', '红楼梦', '三国演义', '水浒传'
        );

        //二维数组
        $array2 = array(
            array('孙悟空', '唐三藏', '沙悟净'),
            array('薛宝钗', '林黛玉', '贾宝玉'),
            array('林冲', '武松', '宋江'),
            array('刘备', '关羽', '张飞'),
        );

        $this->assign('array', $array);
        $this->assign('array2', $array2);

        $this->display();
    }

    //if标签
    public function test15()
    {
        $time = date('N', time());

        $this->assign('time', $time);
        $this->display();
    }

    //sql调试
    public function test17()
    {
        //实例化
        $model = M('Dept');
        $model->where('id > 3');
        $model->select();

        echo $model->getlastSQL();
    }


    //连贯操作
    public function test18()
    {
        //实例化
        $model = M('dept');
        $result = $model->field('name')->where('id > 7')->order('id ASC')->select();
        dump($result);
    }


    //特殊类的实例化
    public function test35()
    {

        $model = D('User');
        dump($model);
    }

    public function test36()
    {
        session('name', '韩梅梅');
        session('name2', '李雷');
        //dump($_SESSION );
        //读取单个
        $name = session('name');
        //清空单个
        //session('name',null);

        //清空全部
        //session(null);

        //读取全部
        //dump(session());

        // dump($_SESSION);

        //判断某个session是否存在
        dump(session('?name'));

    }

    public function test37()
    {
        //1.设置没有有效期的cookie
        cookie('name', 'jack');
        //2.设置带有有效期的cookie
        cookie('name2', 'Dava', 3600);
        //3.获取单个cookie值
        //dump(cookie('name'));
        //4.清空指定的cookie值
        //cookie('name2',null);
        //5.清空全部
        cookie(null);//这段代码系统封装的函数有问题
        //6.获取全部
        dump(cookie());
    }

    public function test38()
    {
        //调用函数
        gbk2utf8();
    }


    //常规验证码
    public function test41()
    {
        //0.配置
        $cfg = array(
            'fontSize' => 12,              // 验证码字体大小(px)
            'useCurve' => false,            // 是否画混淆曲线
            'useNoise' => false,            // 是否添加杂点
            'imageH' => 0,               // 验证码图片高度
            'imageW' => 0,               // 验证码图片宽度
            'length' => 4,               // 验证码位数
            'fontttf' => '4.ttf',              // 验证码字体，不设置随机获取
            'bg' => array(243, 251, 254),  // 背景颜色
            'reset' => true,           // 验证成功后是否重置
        );
        //1.实例化验证码类
        $verfiy = new Verify($cfg);
        //2.输出验证码
        $verfiy->entry();
    }

     //中文验证码
     public function test42(){
        //0.配置
        $cfg = array(
            'fontSize' => 20,              // 验证码字体大小(px)
            'useCurve' => false,            // 是否画混淆曲线
            'useNoise' => false,            // 是否添加杂点
            'imageH' => 0,               // 验证码图片高度
            'imageW' => 0,               // 验证码图片宽度
            'length' => 4,               // 验证码位数
            'useZh'     =>  true,           // 使用中文验证码
            'length' => 3,
        );
        //1.实例化验证码类
        $verfiy = new Verify($cfg);
        //2.输出验证码
        $verfiy -> entry();
     }


     //联表查询
    public function test43(){
        //方法一：使用原生的sql语句
        /*$model = M();
        $sql = "select t1.*,t2.name as deptname from sp_user as t1,sp_dept as t2 where t1.dept_id = t2.id";
        $result = $model -> query($sql);
        dump($result);*/

        //方法二：使用table方法
        $model = M();
        $result = $model ->field('t1.*,t2.name as deptname') ->table('sp_user as t1,sp_dept as t2') -> where('t1.dept_id = t2.id') ->select();
        dump($result);
    }
}