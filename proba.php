<?php
$elem ='<textarea name="comment" lt="ltttt" placeholder="placeholder" data="text1">';
$par='placeholder="';
preg_match_all('/'.$par.'([^`]*?)"/',$elem , $match);
echo  $match[1][0] ;


/*

$h='dfgsdgsdf,';
echo substr($h, 0, -1) ;
$T=[' <div class="mbr-article mbr-article--wysiwyg col-sm-8 col-sm-offset-2" lng="hu"><p>Az interneten számos olyan weblap érheto el,melyek látogatásonkénk fizetnek, például &nbsp;Bitcoinban. Ezeket az oldalakat másnéven fauceteknek, csaptelepeknek hívjuk. Igaz ezek az oldalak bárki számára elérhetoek, viszont felkutatásuk és rendszerezésük meglehetosen idoigényes. Ezért a Socialbittap csapata célul tuzte ki, hogy &nbsp;idorol idore összegyujti, szuri és optimalizált &nbsp;felületen elérhetové teszi felhasználói számára a megbízható és jólzeto weboldalakat'=>'dfgüöügdfg'];
echo $T['<div class="mbr-article mbr-article--wysiwyg col-sm-8 col-sm-offset-2" lng="hu"><p>Az interneten számos olyan weblap érheto el,melyek látogatásonkénk fizetnek, például &nbsp;Bitcoinban. Ezeket az oldalakat másnéven fauceteknek, csaptelepeknek hívjuk. Igaz ezek az oldalak bárki számára elérhetoek, viszont felkutatásuk és rendszerezésük meglehetosen idoigényes. Ezért a Socialbittap csapata célul tuzte ki, hogy &nbsp;idorol idore összegyujti, szuri és optimalizált &nbsp;felületen elérhetové teszi felhasználói számára a megbízható és jólzeto weboldalakat'];

$b=['hhh'];
$a = $b['gg'] ?? true; $b['gg']='hh';
echo $a ;
if($a===$b['gg'] ?? true) {echo 'true';}

trait Ell2{ public  function ell(){
   echo("ell2");
    
}}
trait Ell3{ public  function ell3(){
    echo("ell3");

}}
trait Ell4{ 
 use Ell3;  
    public  function ell4(){
    echo("ell4");

}}

class gg{
// use Ell ;   
 use Ell2 {Ell2::ell as ell2;} 
 use Ell4;    
    
}
$l=explode('_', 'Ell_ghh_ELL');
$gyumolcs = array_pop ($l); //
echo $gyumolcs;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
$gg=new gg();
$gg->ell2();
$gg->ell3();
/ /substr('gjhgj_LT', -2);
$val='gjhgj_LT';
$val=substr($val, 0,-3);
echo $val;
$a=2;$b='b';
$par='[$a,"ha"=>"haha"]';
function proba2($a,$b){
	echo $a.$b;
}
function proba($a){
	echo $a[0].$a['ha'];
}
//proba('elso','masodik');
//proba2(eval($par));
//eval('proba2($a,$b);');
eval('proba('.$par.');');

namespace alap;
use ggg\ddd\proba_trait;
use ggg\ddd\proba_trait2;

include 'proba_trait.php';
//defined( '_MOTTO' ) or die( 'Restricted access' );
class proba{

    public $gg=15;
    use proba_trait2;
    public function egyes(){
        echo 'egyes';
    }

}

//print_r($_POST['value']);
$e='hu';
echo <<<html
<script>
function ff(){
alert('gggggggggggg');
  window.clipboardData.setData('Text', 'gggggggggggggggg');
The David Walsh Blog is the best blog around!  MooTools FTW!

}
</script>
  <form    method="post" action="#" >
   <div class="form-group">
                         <label >en</label>
                         <textarea name="value[en]" class="form-control" rows="5">
                         <!--#value--> </textarea>
                    </div>
                <div class="form-group">
                         <label >$e</label>
                         <textarea name="value[$e]" class="form-control" rows="5">
                         <!--#value--> </textarea>
                    </div>

                </div>-->
                <div class="form-group">
                <label >Verse</label>
                    <input type="text" class="form-control"
                           name="verse" value="<!--#verse-->" >
                </div>
                    <input type="hidden" name="nev" value="<!--#nev-->"/>
                    <div class="form-group">
                        <button type="submit" name="task" value="save"
                                class="btn btn-primary btn-lg">Ment</button>
                        <button type="submit"  name="task" value="save_add"
                               class="btn btn-primary btn-lg" >Ment és új felvitel</button>
                        <button type="button" name="task" value="cancel" onclick="ff()"
                                class="btn btn-primary btn-lg"  >js</button>
                    </div>

                </div>

            </div>
    </form>





html;


/* $ff=new proba();
$ff->egyes_futtat();
$ff::egyes_futtat_stat();*/