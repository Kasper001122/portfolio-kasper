//
// Created by Kasper on 2021-11-22.
//

#include <random>
#include "City.h"

#include "Human.h"
#include "GameSpecs.h"
#include "Organism.h"
#include "Zombie.h"
#include <windows.h>

using namespace std;

City::City() {
    random_device rd;
    mt19937 gen (rd());//random number
    int x;
    int y;
    for (int i=0; i<GRID_HEIGHT;i++){//set every cell to null
        for (int j=0;j<GRID_WIDTH;j++){{
                setOrganism(NULL,i,j);
            }
        }
    }

    uniform_int_distribution<> distr(0,19);//random between 0 19
    for (int i=0;i<HUMAN_STARTCOUNT;i++){//create an amount of humans
        x=distr(gen);//generate x
        y=distr(gen);//generate y
        Human *hm= new Human(this,x,y);//make new human
        hm->setx(x);//manually set x and y
        hm->sety(y);
        setOrganism(hm,x,y);//set organism to place in city
    }
    for (int i=0;i<ZOMBIE_STARTCOUNT;i++){//same thing as human but with zombie
        x=distr(gen);
        y=distr(gen);
        Zombie *zm= new Zombie(this,x,y);
        zm->setx(x);
        zm->sety(y);
        setOrganism(zm,x,y);
    }

}

City::~City() {

}

Organism *City::getOrganism(int x, int y) {//gets an organism unless it doesnt exist(not used)
    if (grid[x][y]==NULL){
        return NULL;
    }
    return  grid[x][y];
}

void City::setOrganism(Organism *organism, int x, int y) {//sets an organism
    grid[y][x]=organism;
}
boolean City::hasDiversity(){//checks if there are both humans and zombies if not the program exits and extinction level event occurs
    int humans=0;
    int zombies=0;

    for (int i=0; i<GRID_HEIGHT;i++){

        for (int j=0;j<GRID_WIDTH;j++){

            if (grid[i][j]!=NULL){

                if (grid[i][j]->getOrganismType() == 1) {//human
                    humans=humans+1;
                    }
                else if (grid[i][j]->getOrganismType() == 2) {//zombie
                    zombies=zombies+1;
                }
            }
        }
    }
    if (humans>0 && zombies>0){//if there are both human and zombie
        return true;
    }else{//if not
        return false;
    }}

void City::move() {
    for (int i=0; i<GRID_HEIGHT;i++){//goes through the city array
        for (int j=0;j<GRID_WIDTH;j++){
            if (grid[i][j]!=NULL) {//if its not null
                if (grid[i][j]->getOrganismType() == 1) {//human
                    if(grid[i][j]->getBreed()!=0) {//if it breed is not 0
                        grid[i][j]->move();//move it
                    }else{//if its been 3 turns
                        grid[i][j]->Breed();//create new human
                    }
                } else if (grid[i][j]->getOrganismType() == 2) {//zombie
                    if(grid[i][j]->getBreed()>0){//if its breed counter is larger then 0
                        grid[i][j]->move();//just move it (in turn eat)
                    }else{
                        grid[i][j]->Breed();//if its ready to breed it breeds instead
                    }

                }
            }
        }
    }


}




