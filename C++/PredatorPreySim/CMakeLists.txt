cmake_minimum_required(VERSION 3.20)
project(AS4)

set(CMAKE_CXX_STANDARD 14)

add_executable(AS4 main.cpp Human.cpp Zombie.cpp Organism.cpp City.cpp GameSpecs.cpp)
