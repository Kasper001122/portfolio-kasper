//
// Created by Kasper on 2021-11-22.
//

#include <vector>
#include <random>
#include <chrono>
#include <algorithm>
#include "Human.h"
#include "City.h"
#include "Human.h"
#include "GameSpecs.h"
#include "Organism.h"
#include "Zombie.h"
Human::Human() {
    isHuman=1;
    width=GRID_WIDTH;
    height=GRID_HEIGHT;
    moved=false;
//might be bettter to move this stuff to the other constructor and just use that
}

Human::Human(City *city, int width, int height) : Organism(city, width, height) {
    isHuman=1;
    breed=3;
    width=GRID_WIDTH;
    height=GRID_HEIGHT;
    moved=false;
    this->city=city;
//    this->x=width;
//    this->y=height;
    //cout<<x<<" "<<y<<endl;

}

Human::~Human() {

}
void Human::getPosition() {}
void Human::setx(int rightx){
    this->x=rightx;
}
void Human::sety(int righty){
    this->y=righty;
}

void Human::endTurn(){
    moved=false;
}
void Human::Breed(){//very simular to move but creates new human and doesnt delete old one. since move is more complicated ill go through that one
    int oldX=x;
    int oldY=y;
    vector<int> direc;
    if (x == 0) {

    } else {

        if (city->grid[y][x-1] == nullptr) {
            direc.push_back(1);//west
        }else if (city->grid[y][x-1] != nullptr) {
        }
    }
    if (x == 19) {
    } else {
        if (city->grid[y][x+1] == nullptr) {
            direc.push_back(2);//east
        }else if (city->grid[y][x+1] != nullptr){
        }
    }
    if (y == 0) {
    } else {
        if (city->grid[y-1][x] == nullptr) {
            direc.push_back(3);//north
        }else if (city->grid[y-1][x] != nullptr){

        }
    }
    if (y == 19) {

    } else {

        if (city->grid[y+1][x] == nullptr) {
            direc.push_back(4);//south
        }
        else if (city->grid[y+1][x] != nullptr){
        }
    }
    int going;
    unsigned seed = chrono::system_clock::now().time_since_epoch().count();//create random seed using system clock
    shuffle(direc.begin(), direc.end(), default_random_engine(seed));
    Human *newHuman=new Human(city,x,y);//new human
    newHuman->moved=true;//make it so it apppears hes moved
    if(!direc.empty()) {
        going = direc[0];
    }else{
        going=0;
    }
    if (going == 1) {//these place the new organism somewhere that is free
        newHuman->setx(x - 1);
        newHuman->sety(y);
        this->breed=3;
        city->setOrganism(newHuman,newHuman->x, newHuman->y);
    } else if (going == 2) {
        newHuman->setx(x + 1);
        newHuman->sety(y);
        this->breed=3;
        city->setOrganism(newHuman,newHuman->x, newHuman->y);
    } else if (going == 3) {
        newHuman->setx(x);
        newHuman->sety(y - 1);
        this->breed=3;
        city->setOrganism(newHuman,newHuman->x, newHuman->y);
    } else if (going == 4) {
        newHuman->setx(x);
        newHuman->sety(y + 1);
        this->breed=3;
        city->setOrganism(newHuman,newHuman->x, newHuman->y);
    }else if(going==0){//if the human could not breed(no spaces available)
        this->breed=3;//set counter back to 3
    }
}
void Human::move() {
    if (!moved) {//if i havnt moved

        int oldX=x;//grab some values that will change
        int oldY=y;
        vector<int> direc;//directions 1=west 2=east 3=north 4=south
        if (x == 0) {//the x==0 or 19 and y==0 or 19 are there to catch if they are on borders

        } else {

            if (city->grid[y][x-1] == nullptr) {
                direc.push_back(1);//west
            }else if (city->grid[y][x-1] != nullptr) {

            }
        }
        if (x == 19) {

        } else {

            if (city->grid[y][x+1] == nullptr) {
                direc.push_back(2);//east
            }else if (city->grid[y][x+1] != nullptr){

            }
        }
        if (y == 0) {

        } else {
//
            if (city->grid[y-1][x] == nullptr) {
                direc.push_back(3);//north
            }else if (city->grid[y-1][x] != nullptr){

            }
        }
        if (y == 19) {

        } else {

            if (city->grid[y+1][x] == nullptr) {
                direc.push_back(4);//south
            }
            else if (city->grid[y+1][x] != nullptr){

            }
        }
        int going;//used to determine where im going to
        unsigned seed = chrono::system_clock::now().time_since_epoch().count();//create random seed using system clock
        shuffle(direc.begin(), direc.end(), default_random_engine(seed));//shuffle vector
        if(!direc.empty()) {//if its not empty
            going = direc[0];//grab the first one
        }else{//if it is empty
            going=0;//set to 0 which is used to not do anything
        }

        if (going == 1) {//if west
            moved=true;//they are about to move so set it
            this->setx(x - 1);//set their new position
            this->sety(y);
        } else if (going == 2) {//if east
            moved=true;//most of these are the same as west but changed values
            this->setx(x + 1);
            this->sety(y);
        } else if (going == 3) {//if north
            moved=true;
            this->setx(x);
            this->sety(y - 1);
        } else if (going == 4) {//if south
            this->setx(x);
            this->sety(y + 1);
            moved=true;
        }
        //set this human at new position
        city->setOrganism(this,this->x, this->y);
        if(moved){//if we moved at all
            this->breed=this->breed-1;//-breed counter
            city->setOrganism(nullptr, oldX, oldY);//make old spot a null

        }else{//if we didnt move
            this->breed=3;//reset breed
        }



    }
}

