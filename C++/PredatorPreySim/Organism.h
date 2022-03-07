#ifndef _Organism_H
#define _Organism_H

#include <iostream>

using namespace std;

class City;

class Organism
{
protected:
	int x;
	int y;
    int width;
    int height;
	bool moved;//false if they havnt moved yet true if they have
    int breed;//turns until breed
    int isHuman;//0 = nothing 1 = human = 2 =zombie
	City *city;

	enum { WEST, NORTH, EAST, SOUTH, NUM_DIRECTIONS };

public:
	Organism();
	Organism( City *city, int width, int height );
	virtual ~Organism();

	virtual void move() = 0;
    virtual void Breed() = 0;
    //some of these i didnt use or made my own
	//virtual void spawn() = 0;
	//virtual int getSpecies() = 0; //this could also be coded concrete here
	virtual void getPosition() = 0;
//    virtual void setx(int rightx ) = 0;
//    virtual void sety(int righty) = 0;
	void setPosition( int x, int y );
	void endTurn();
	bool isTurn();

//	friend ostream& operator<<( ostream &output, Organism *organism ){
//
//
//
//        return output;
//    };
    int getBreed();

    int getOrganismType();
};

#endif
