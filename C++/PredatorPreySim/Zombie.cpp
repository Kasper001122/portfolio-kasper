//
// Created by Kasper on 2021-11-22.
//

#include "Zombie.h"
#include "City.h"
#include "Human.h"
#include "GameSpecs.h"
#include "Organism.h"
#include "Zombie.h"
#include <vector>
#include <random>
#include <chrono>
#include <algorithm>
Zombie::Zombie() {
    isHuman=2;
    isHuman=2;
    breed=8;
    starve=3;
    width=GRID_WIDTH;
    height=GRID_HEIGHT;
    moved=false;
}
//very simular to human
Zombie::Zombie(City *city, int width, int height) : Organism(city, width, height) {
    isHuman=2;//zombie
    breed=8;//turn counter
    starve=3;//starve counter
    width=GRID_WIDTH;
    height=GRID_HEIGHT;
    moved=false;//hasnt moved
    this->city=city;//city
}

Zombie::~Zombie() {

}
void Zombie::endTurn(){
    moved=false;
}



void Zombie::getPosition(){

}
void Zombie::setx(int rightx){
    this->x=rightx;
}
void Zombie::sety(int righty){
    this->y=righty;
}
void remove(std::vector<int> &v)//https://www.techiedelight.com/remove-duplicates-vector-cpp/
{//removes duplicates
    auto end = v.end();
    for (auto it = v.begin(); it != end; ++it) {
        end = std::remove(it + 1, end, *it);
    }
    v.erase(end, v.end());
}
void Zombie::Breed(){//simular to move but we do not grab empty areas we just check for humans
    //we only see if there is an empty spot and do nothing to it.
    bool onNorthBorder=false;
    bool onEastBorder=false;
    bool onSouthBorder=false;
    bool onWestBorder=false;
    if (this->y == 19) {
        onSouthBorder=true;
    }
    if (this->x == 0) {
        onWestBorder=true;
    }
    if (this->x == 19) {
        onEastBorder=true;
    }
    if (this->y == 0) {
        onNorthBorder=true;
    }
    int oldX=x;
    int oldY=y;

    vector<int> humanDirec;
    if (onWestBorder) {
    } else {
        if (city->grid[y][x-1]==nullptr){//west
        }else if (city->grid[y][x-1]->getOrganismType() ==1) {
            humanDirec.push_back(1);
        }
        if(!onSouthBorder){
            if(city->grid[y+1][x-1]== nullptr){//southwest

            }else if (city->grid[y+1][x-1]->getOrganismType() ==1){
                humanDirec.push_back(8);
            }
        }
        if(!onNorthBorder) {
            if (city->grid[y - 1][x - 1] == nullptr) {//northwest

            } else if (city->grid[y - 1][x - 1]->getOrganismType() == 1) {
                humanDirec.push_back(5);
            }
        }
    }
    if (onEastBorder) {
    } else {
        if (city->grid[y][x+1] == nullptr) {
            //east
        }else if (city->grid[y][x+1]->getOrganismType() ==1){
            humanDirec.push_back(2);
        }
        if (!onNorthBorder) {
            if (city->grid[y - 1][x + 1] == nullptr) {
                //northeast
            } else if (city->grid[y - 1][x + 1]->getOrganismType() == 1) {
                humanDirec.push_back(6);
            }
        }
        if(!onSouthBorder){
            if (city->grid[y+1][x+1] == nullptr) {
                //southeast
            }else if (city->grid[y+1][x+1]->getOrganismType() ==1){
                humanDirec.push_back(7);
            }
        }
    }
    if (onNorthBorder) {
    } else {
//
        if (city->grid[y-1][x] == nullptr) {
           //north
        }else if (city->grid[y-1][x] ->getOrganismType() ==1){
            humanDirec.push_back(3);
        }
        if(!onEastBorder) {
            if (city->grid[y - 1][x + 1] == nullptr ) {
                //northeast
            } else if (city->grid[y - 1][x + 1]->getOrganismType() == 1 ) {
                humanDirec.push_back(6);
            }
        }
        if(!onWestBorder) {
            if (city->grid[y - 1][x - 1] == nullptr) {//northwest

            } else if (city->grid[y - 1][x - 1]->getOrganismType() == 1) {
                humanDirec.push_back(5);
            }
        }
    }
    if (onSouthBorder) {
    } else {

        if (city->grid[y+1][x] == nullptr) {
            //south
        }
        else if (city->grid[y+1][x] ->getOrganismType() ==1){
            humanDirec.push_back(4);
        }
        if(!onEastBorder) {
            if (city->grid[y + 1][x + 1] == nullptr ) {
                //southeast
            } else if (city->grid[y + 1][x + 1]->getOrganismType() == 1) {
                humanDirec.push_back(7);
            }
        }
        if(!onWestBorder) {
            if (city->grid[y + 1][x - 1] == nullptr ) {//southwest
            } else if (city->grid[y + 1][x - 1]->getOrganismType() == 1) {
                humanDirec.push_back(8);
            }
        }
    }
    remove(humanDirec);
    int converting;//converting integer
    if (humanDirec.empty()){//if there were no humans nearby just move
        this->move();
    }else if(!humanDirec.empty()){
        unsigned seed = chrono::system_clock::now().time_since_epoch().count();//create random seed using system clock
        shuffle(humanDirec.begin(), humanDirec.end(), default_random_engine(seed));
        converting=humanDirec[0];//grab random human nearby
        Zombie *convertedHuman=new Zombie(city,x,y);//make new zombie
        if (converting == 1) {//this sets up the zombie in the same place the human was
            moved=true;
            convertedHuman->setx(x - 1);
            convertedHuman->sety(y);
        } else if (converting == 2) {
            moved=true;
            convertedHuman->setx(x + 1);
            convertedHuman->sety(y);
        } else if (converting== 3) {
            moved=true;
            convertedHuman->setx(x);
            convertedHuman->sety(y - 1);
        } else if (converting == 4) {
            convertedHuman->setx(x);
            convertedHuman->sety(y + 1);
            moved=true;
        }else if(converting==5){
            convertedHuman->setx(x-1);
            convertedHuman->sety(y - 1);
            moved=true;
        }
        else if(converting==6){
            convertedHuman->setx(x+1);
            convertedHuman->sety(y - 1);
            moved=true;
        }
        else if(converting==7){
            convertedHuman->setx(x+1);
            convertedHuman->sety(y + 1);
            moved=true;
        }
        else if(converting==8){
            convertedHuman->setx(x-1);
            convertedHuman->sety(y +1 );
            moved=true;
        }

        city->setOrganism(nullptr,convertedHuman->x,convertedHuman->y);//kills human
        city->setOrganism(convertedHuman,convertedHuman->x,convertedHuman->y);//places new zombie
        this->breed=8;//sets the zombie that converted the humans breed counter to 8 to reset it.
    }
}
void Zombie::move() {//move command
    if (!moved) {//if i havnt moved
        bool onNorthBorder=false;//set some borders to false
        bool onEastBorder=false;
        bool onSouthBorder=false;
        bool onWestBorder=false;
        if (this->y == 19) {//check if you are on any border
            onSouthBorder=true;
        }
        if (this->x == 0) {
            onWestBorder=true;
        }
        if (this->x == 19) {
            onEastBorder=true;
        }
        if (this->y == 0) {
            onNorthBorder=true;
        }
        int oldX=x;//grab some values before they change
        int oldY=y;
        vector<int> direc;//vector of empty spaces
        vector<int> humanDirec;//vector of spaces with humans
        if (onWestBorder) {//if im on the west border do nothing acts the same for the rest of the 4 basic directions buit with north, south , and east

        } else {

            if (city->grid[y][x-1]==nullptr){//west is empty
                direc.push_back(1);//put it in list of null areas
            }else if (city->grid[y][x-1]->getOrganismType() ==1) {//if west has a human in it
                humanDirec.push_back(1);//put the direction in the humans list
            }
            if(!onSouthBorder){//if we are not on the south border
            if(city->grid[y+1][x-1]== nullptr){//southwest
                direc.push_back(8);//if south west is empty and we are not on the border put it in the nulls list
            }else if (city->grid[y+1][x-1]->getOrganismType() ==1){//if its a human
                humanDirec.push_back(8);//put it in the human list
            }
            }
            //functions the same as south border but for north west
            if(!onNorthBorder) {
                if (city->grid[y - 1][x - 1] == nullptr) {//northwest
                    direc.push_back(5);
                } else if (city->grid[y - 1][x - 1]->getOrganismType() == 1) {
                    humanDirec.push_back(5);
                }
            }
        }
        //most of these are the same but with minor changes
        //essentially if your not on the border grab the basic direction of where that border would be
        //then for the varients (northwest and norteast or southeast southwest) check if you are on the specific border before grabbing it and putting in the lists
        if (onEastBorder) {

        } else {

            if (city->grid[y][x+1] == nullptr) {
                direc.push_back(2);//east
            }else if (city->grid[y][x+1]->getOrganismType() ==1){
                humanDirec.push_back(2);
            }
            if (!onNorthBorder) {
                if (city->grid[y - 1][x + 1] == nullptr) {
                    direc.push_back(6);//northeast
                } else if (city->grid[y - 1][x + 1]->getOrganismType() == 1) {
                    humanDirec.push_back(6);
                }
            }
            if(!onSouthBorder){
            if (city->grid[y+1][x+1] == nullptr) {
                direc.push_back(7);//southeast
            }else if (city->grid[y+1][x+1]->getOrganismType() ==1){
                humanDirec.push_back(7);
            }
                }
        }
        if (onNorthBorder) {


        } else {

            if (city->grid[y-1][x] == nullptr) {
                direc.push_back(3);//north
            }else if (city->grid[y-1][x] ->getOrganismType() ==1){
                humanDirec.push_back(3);
            }
            if(!onEastBorder) {
                if (city->grid[y - 1][x + 1] == nullptr ) {
                    direc.push_back(6);//northeast
                } else if (city->grid[y - 1][x + 1]->getOrganismType() == 1 ) {
                    humanDirec.push_back(6);
                }
            }
            if(!onWestBorder) {
                if (city->grid[y - 1][x - 1] == nullptr) {//northwest
                    direc.push_back(5);
                } else if (city->grid[y - 1][x - 1]->getOrganismType() == 1) {
                    humanDirec.push_back(5);
                }
            }
        }
        if (onSouthBorder) {
        } else {

            if (city->grid[y+1][x] == nullptr) {
                direc.push_back(4);//south
            }
            else if (city->grid[y+1][x] ->getOrganismType() ==1){
                humanDirec.push_back(4);
            }
            if(!onEastBorder) {
                if (city->grid[y + 1][x + 1] == nullptr ) {
                    direc.push_back(7);//southeast
                } else if (city->grid[y + 1][x + 1]->getOrganismType() == 1) {
                    humanDirec.push_back(7);
                }
            }
            if(!onWestBorder) {
                if (city->grid[y + 1][x - 1] == nullptr ) {//southwest
                    direc.push_back(8);
                } else if (city->grid[y + 1][x - 1]->getOrganismType() == 1) {
                    humanDirec.push_back(8);
                }

            }
        }
        //this removes duplicate values and leaves only 1 version of it
        remove(direc);
        remove(humanDirec);


        //cout<<endl;
        //initializing
        int going=0;
        int eating=0;
        if (!humanDirec.empty()){//if human list has someone in it eat one of them
            unsigned seed = chrono::system_clock::now().time_since_epoch().count();//create random seed using system clock
            shuffle(humanDirec.begin(), humanDirec.end(), default_random_engine(seed));
            eating=humanDirec[0];//random human in list
            this->eat(eating);//eat them
        }
        else if(!direc.empty()){//if human list is empty and direc list has values. IE not trapped
            unsigned seed = chrono::system_clock::now().time_since_epoch().count();//create random seed using system clock
            shuffle(direc.begin(), direc.end(), default_random_engine(seed));
            going=direc[0];//randomly grab one of the available directions
            if (going == 1) {//west
                moved=true;
                this->setx(x - 1);
                this->sety(y);
            } else if (going == 2) {//east
                moved=true;
                this->setx(x + 1);
                this->sety(y);
            } else if (going == 3) {//north
                moved=true;
                this->setx(x);
                this->sety(y - 1);
            } else if (going == 4) {//south
                this->setx(x);
                this->sety(y + 1);
                moved=true;
            }else if(going==5){//northwest
                this->setx(x-1);
                this->sety(y - 1);
                moved=true;
            }
            else if(going==6){//northeast
                this->setx(x+1);
                this->sety(y - 1);
                moved=true;
            }
            else if(going==7){//southeast
                this->setx(x+1);
                this->sety(y + 1);
                moved=true;
            }
            else if(going==8){//southwest
                this->setx(x-1);
                this->sety(y +1 );
                moved=true;
            }
            //set organism to new place
            city->setOrganism(this,this->x, this->y);

            if(moved) {//if we moved
                this->starve = this->starve - 1;//starve goes down by 1
                city->setOrganism(nullptr, oldX, oldY);//get rid of old placement
                if(starve<=0){//if starve is below 1
                    city->setOrganism(nullptr, this->x, this->x);//kill zombie
                    Human *replace= new Human(city,x,y);//make new human
                    replace->setx(this->x);//set up human
                    replace->sety(this->y);
                    city->setOrganism(replace, this->x, this->x);//place new human where zombie died
                }
            }
        }
        this->breed = this->breed - 1;//make breed counter go down
    }

}

void Zombie::eat(int compass) {//very simular to later half of move
    int oldX=x;
    int oldY=y;
    if (compass == 1) {
        moved=true;
        this->setx(x - 1);
        this->sety(y);
    } else if (compass == 2) {
        moved=true;
        this->setx(x + 1);
        this->sety(y);
    } else if (compass == 3) {
        moved=true;
        this->setx(x);
        this->sety(y - 1);
    } else if (compass == 4) {
        this->setx(x);
        this->sety(y + 1);
        moved=true;
    }else if(compass==5){
        this->setx(x-1);
        this->sety(y - 1);
        moved=true;
    }
    else if(compass==6){
        this->setx(x+1);
        this->sety(y - 1);
        moved=true;
    }
    else if(compass==7){
        this->setx(x+1);
        this->sety(y + 1);
        moved=true;
    }
    else if(compass==8){
        this->setx(x-1);
        this->sety(y +1 );
        moved=true;
    }//big difference between this and moves final part
    city->setOrganism(nullptr,this->x, this->y);//kill human
    city->setOrganism(this,this->x, this->y);//put zombie on where human died
    city->setOrganism(nullptr,oldX, oldY);//null where zombie was

    this->starve=3;//reset starve counter
}

