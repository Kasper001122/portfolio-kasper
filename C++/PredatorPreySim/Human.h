#ifndef _Human_H
#define _Human_H

#include "Organism.h"

class Human : public Organism
{
public:
	Human(); 
	Human( City *city, int width, int height );
	virtual ~Human();
    void getPosition();//not used
    void setx(int rightx);
    void sety(int righty);
    void move();
    void endTurn();//not used
    void Breed();
};

#endif
