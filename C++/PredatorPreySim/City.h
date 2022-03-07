#ifndef _CITY_H
#define _CITY_H

#include <iostream>
#include "windows.h"
#include "Organism.h"
#include "GameSpecs.h"
using namespace std;

class Organism;

const int GRID_WIDTH = 20;
const int GRID_HEIGHT = 20;

class City
{
//vector<vector<Organism>> grid={};

public:
    Organism *grid[GRID_HEIGHT][GRID_WIDTH];
	City();
	virtual ~City();

	Organism *getOrganism( int x, int y );
	void setOrganism( Organism *organism, int x, int y );

	void move();

    static void Col(int c)//doesnt work
    {
        HANDLE  hConsole;
        hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
        SetConsoleTextAttribute(hConsole, c);
        return;
    }
	friend ostream& operator<<( ostream &output, City &city ){
        HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);//doesnt work but is here in case it works for someone else
        int humanCount=0;//counters
        int zombieCount=0;
        for (int i=0; i<GRID_HEIGHT;i++){//these for loops go through the array
            //output<<"Line: "<<i<<"      ";//helps keep track of where everything is
            for (int j=0;j<GRID_WIDTH;j++){
                if (city.grid[i][j]!=NULL) {//if a object in the array is not null
                    if (city.grid[i][j]->getOrganismType() == 1) {//if the object is human
                        SetConsoleTextAttribute(hConsole,3);//use human colors
                        humanCount=humanCount+1;//add to human count
                        output<<" "<< HUMAN_CH <<" ";//print human char
                    } else if (city.grid[i][j]->getOrganismType() == 2) {//if object is zombie
                        zombieCount=zombieCount+1;//add to zombie count
                        SetConsoleTextAttribute(hConsole,14);//use zombie color
                        output <<" " << ZOMBIE_CH <<" ";//print zombie color
                    }
                }
                else{//if null
                    SetConsoleTextAttribute(hConsole,2);//use null color
                    //city.grid[i][j]=nullptr;
                    output<<" - ";//output -
                }
            }
            SetConsoleTextAttribute(hConsole,7);//set color back to white
            output<<endl;//extra space
        }
        for (int i=0; i<GRID_HEIGHT;i++){//ends turn and makes all moved bools to false
            for (int j=0;j<GRID_WIDTH;j++){
                if (city.grid[i][j]!=NULL) {
                    if (city.grid[i][j]->getOrganismType() == 1) {
                        city.grid[i][j]->endTurn();
                    } else if (city.grid[i][j]->getOrganismType() == 2) {
                        city.grid[i][j]->endTurn();
                    }
                }
            }
        }
        output <<"ZOMBIE COUNT: "<<zombieCount<<endl;//outputs num of humans and zombies
        output <<"HUMAN COUNT: "<<humanCount<<endl;
        return output;
    };


    boolean hasDiversity();
};

#endif

