package com.example.as2quizbuilder;

public class checkDupes {
    public static Boolean checkDuplicate(String answer, String correctAnswer){
        if (answer==correctAnswer){// tests if the answer clicks is correct
            return true;
        }else{
            return false;
        }

    }
}
