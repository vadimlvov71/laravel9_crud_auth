<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class TestController extends Controller
{
    
    public function index()
    {
        //echo "123test";
       /* $user = new User();
        $user->setFirstName('John')
        ->setLastName('Doe')
        ->setEmail('john.doe@example.com')
        ;
        echo $user;*/
        ///$car = new Car([new Door(true), new Tyre(true), new Hood(true)]); // we pass a list of all details
        $attacker = new Attacker();
        $defender = new Defender();
        $fight = New FightService();
        $obj = $fight->fight($attacker, $defender);
    }

}
class Attacker implements HeroInterface{
   function getAttack(): int
   {
        return 1;
   }
   public function getDefence(): int
   {
        return 0;
   }
   function getHealthPoints(): int
   {
        return 10;
   }
   function setHealthPoints(int $healthPoints): int
   {
        return 10;
   }
}
class Defender implements HeroInterface{

    function getAttack(): int
    {
         return 0;
    }
    function getDefence(): int
    {
         return 1;
    }
    function getHealthPoints(): int
    {
         return 10;
    }
    function setHealthPoints(int $healthPoints): int
    {
         return 10;
    }
 }
interface HeroInterface
{
    public function getAttack(): int;

    public function getDefence(): int;

    public function getHealthPoints(): int;

    public function setHealthPoints(int $healthPoints);
}

class DamageCalculator
{
    const DAMAGE_RAND_FACTOR = 0.2;

    public static function calculateDamage(HeroInterface $attacker, HeroInterface $defender): int
    {
        $damage = 0;

        if ($attacker->getAttack() > $defender->getDefence()) {
            $baseDamage = $attacker->getAttack() - $defender->getDefence();

            $factor = $baseDamage * self::DAMAGE_RAND_FACTOR;

            $minDamage = $baseDamage - $factor;
            $maxDamage = $baseDamage + $factor;

            $damage = mt_rand($minDamage, $maxDamage);
        }

        return $damage;
    }
}

class FightService
{    
    public function fight(HeroInterface $attacker, HeroInterface $defender)
    {
        $damage = DamageCalculator::calculateDamage($attacker, $defender);
        echo $damage."<br>";
        $healthPoints = $defender->setHealthPoints($defender->getHealthPoints() - $damage);
        echo($healthPoints);
    }
}

class FightServiceTest extends TestCase {

    public function testFight()
    {
        $damage = DamageCalculator::calculateDamage($attacker, $defender);
        self::assertSame(0, $damage);
        $healthPoints = $defender->setHealthPoints($defender->getHealthPoints() - $damage);
        self::assertSame(10, $healthPoints);
    }
}


/*
abstract class CarDetail {

    protected $isBroken;
    

    public function __construct(bool $isBroken)
    {
        $this->isBroken = $isBroken;
    }

    public function isBroken(): bool
    {
        return $this->isBroken;
    }
}

class Door extends CarDetail
{
}

class Tyre extends CarDetail
{
}

class Hood extends CarDetail
{
}
class Car
{

    /**
     * @var CarDetail[]
     */
  //  private $details;
  //  private $noPaintDetailsList = ["App\Http\Controllers\Tyre"];
    /**
     * @param CarDetail[] $details
     */
  /*  public function __construct(array $details)
    {
        $this->details = $details;
        echo $this->isPaintingDamaged();
    }
    /// TODO: may be it means - create a list of damages details????
    public function isBroken(): bool
    {
        foreach ($this->details as $detail) {

            if ($detail->isBroken() )  {
                if (!in_array(get_class($detail), $this->noPaintDetailsList)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function isPaintingDamaged(): bool
    {
        return $this->isBroken();
    }
}









/*
class User {
    private $first_name;
    private $last_name;
    private $email;

    function setFirstName($first_name){
        $this->first_name = $first_name;
        return $this;
    }
    function setLastName($last_name){
        $this->last_name = $last_name;
        return $this;
    }
    function setEmail($email){
        $this->email = $email;
        return $this;
    }
    ///setters
    function getFirstName(){
        return $this->first_name;
    }
    function getLastName(){
        return $this->last_name;
    }
    function getEmail(){
        return $this->email;
    }
   
    public function __toString() {
        return $this->first_name. " " .$this->last_name. " " .$this->email ;
    }
}*/
