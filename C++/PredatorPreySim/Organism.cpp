//
// Created by Kasper on 2021-11-22.
//

#include "Organism.h"
#include "City.h"
#include "Human.h"
#include "GameSpecs.h"
#include "Organism.h"
#include "Zombie.h"
Organism::Organism() {

}

Organism::Organism(City *city, int width, int height) {

}

Organism::~Organism() {

}

void Organism::setPosition(int x, int y) {//never used

}

int Organism::getOrganismType() {//grabs type human or zombie
    return isHuman;
}
void Organism::endTurn() {//sets moved to false
    moved=false;
}

bool Organism::isTurn() {//not used
    return false;
}

int Organism::getBreed() {//returns how many turns left until breed
    return this->breed;
}

