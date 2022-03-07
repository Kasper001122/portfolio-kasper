#ifndef _Zombie_H
#define _Zombie_H

#include "Organism.h"

class Zombie : public Organism
{
public:
    int starve;//starve counter
	Zombie();
	Zombie( City *city, int width, int height );
	virtual ~Zombie();



    void move();

    void getPosition();

    void setx(int rightx);

    void sety(int righty);
    void eat(int compass);



    void endTurn();

    void Breed();
};

#endif
