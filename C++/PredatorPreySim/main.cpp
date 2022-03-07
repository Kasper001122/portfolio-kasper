#include <iostream>
#include <chrono>
#include <thread>
#include "City.h"
#include "Human.h"
#include "GameSpecs.h"
#include "Organism.h"
#include "Zombie.h"
using namespace std;
void ClearScreen()
{
    cout << "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
}
int main() {
    //COLOR DOES NOT WORK FOR MY IDE
    //the code is available ive tried both Col() and just doing it outright but it doesnt work. code is still in program
    int x=0;//iterator
    City *city= new City();//basic start and show
    cout<<*city;
    chrono:: milliseconds interval(INTERVAL);

    while (city->hasDiversity()==true && x<100 ) { //while both humans and zombies exist

        this_thread::sleep_for(interval);

        ClearScreen();

        city->move();
        cout<<*city;
        cout<<"ITERATION "<<x<<endl;//shows iteration

        x++;

    }
    if (city->hasDiversity()==false){
        cout<<"EXTINCTION LEVEL EVENT"<<endl;
    }else{
        cout<<"HUMANS AND ZOMBIES CO-EXIST"<<endl;
    }

    return 0;
}
