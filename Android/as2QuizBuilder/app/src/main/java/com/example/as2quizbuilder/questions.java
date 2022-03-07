package com.example.as2quizbuilder;

import androidx.appcompat.app.AppCompatActivity;

import android.graphics.Color;
import android.os.Bundle;
import android.os.*;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import java.util.ArrayList;
import java.io.*;
import java.util.*;

public class questions extends AppCompatActivity {
    //initializing
    TextView name;
    int quizLength;
    String correctAnswer;
    String currentDef="";
    String currentAnswer;
    String firstGuess="";
    int score=0;
    String as1 ;
    String as2 ;
    String as3 ;
    int i=0;
    final String tag= "Error";// tage for logs
    Button answer1, answer2, answer3,answer4, nextQ;
    TextView def;
    TextView notify;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_questions);
        //hooking up variables
        name=findViewById(R.id.name);
        Bundle editName=getIntent().getExtras();
        name.setText(editName.getString("userName"));
        //important  arrays
        //definition array
        ArrayList<String> definitions= new ArrayList<String>();
        //term array
        ArrayList<String> answers= new ArrayList<String>();
        //used for hooking up the terms to definitions
        HashMap<String,String>hashes= new HashMap<>();

        //hooking up more variables
        notify=findViewById(R.id.notfiy);
        //buttons for terms
        answer1=findViewById(R.id.answer1);
        answer2=findViewById(R.id.answer2);
        answer3=findViewById(R.id.answer3);
        answer4=findViewById(R.id.answer4);
        //next quesstion buttons beings as "start"
        nextQ=findViewById(R.id.nextQ);
        //text view
        def= findViewById(R.id.definition);
        //str is the line of a file and buffered reader is needed for file opening
        String str = null;
        BufferedReader br = null;

        try {
            //grabs the file
            InputStream is=getResources().openRawResource(R.raw.quiz);
            br = new BufferedReader( new InputStreamReader(is));//sets buffered reader

            while ((str = br.readLine())!=null){//grabs lines 1 by 1

                if (str.contains("?")){//if it contains a ? it means its a question
                    definitions.add(str);

                }
                else if (str.contains("^")){//if it contains a ^ it is the correct answer

                    str =str.replace("^","");//get rid of the ^
                    answers.add(str);//put it into the answers list
                    hashes.put(definitions.get(i),str);//pairs the answer to the questions
                    i=i+1;//counter for later things
                }
                else {
                    answers.add(str);//incorrect answers added to list
                }
            }




            Collections.shuffle(definitions);//shuffles definitions list


            is.close();//closes file
            quizLength= definitions.size();//grabs the length of the quiz used for later


//            System.out.println(s);
        }catch (IOException e){//some exception handling
            Log.e(tag,e.getMessage());//logs
        }
        catch (Exception e){
            Log.e("Something Went Wrong while reading the file: ", e.getMessage());
    }
        //buttons for answers
        answer1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try{
                if (!currentDef.equals("")){//if the definition text view is not empty
                    if (firstGuess.equals("")){//if the user has not made their first guess
                        firstGuess=answer1.getText().toString();//saves their first guess to a variable for score calculations
                    }
                    currentAnswer=answer1.getText().toString();//changes answer to it
                    if (currentAnswer.equals(correctAnswer)){//if it is the correct term

                        notify.setTextColor(Color.GREEN);//tell the user its correct
                        notify.setText("Correct Answer");
                    }else {// if not tell the user its not
                        notify.setTextColor(Color.RED);//https://stackoverflow.com/questions/4602902/how-to-set-the-text-color-of-textview-in-code
                        notify.setText("Incorrect Answer");
                    }
                }
            }catch (Exception e){//tells me if there is an issue with the buttons
                    Log.e("Error on button push: ", e.getMessage());
                }
            }
        });
        //repeat answer1 but now its answer2 and so on
        answer2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try{
                if ((!currentDef.equals(""))){
                    if (firstGuess.equals("")){
                        firstGuess=answer2.getText().toString();
                    }
                    currentAnswer=answer2.getText().toString();
                    if (currentAnswer.equals(correctAnswer)){

                        notify.setTextColor(Color.GREEN);
                        notify.setText("Correct Answer");
                    }else {
                        notify.setTextColor(Color.RED);//https://stackoverflow.com/questions/4602902/how-to-set-the-text-color-of-textview-in-code
                        notify.setText("Incorrect Answer");
                    }
                }
            }catch (Exception e){
                    Log.e("Error on button push: ", e.getMessage());
                }}
        });
        answer3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try{
                if ((!currentDef.equals(""))){
                    if (firstGuess.equals("")){
                        firstGuess=answer3.getText().toString();
                    }
                    currentAnswer=answer3.getText().toString();
                    if (currentAnswer.equals(correctAnswer)){
                        notify.setTextColor(Color.GREEN);
                        notify.setText("Correct Answer");
                    }else {
                        notify.setTextColor(Color.RED);//https://stackoverflow.com/questions/4602902/how-to-set-the-text-color-of-textview-in-code
                        notify.setText("Incorrect Answer");
                    }
                }
            }catch (Exception e){
                    Log.e("Error on button push: ", e.getMessage());
                }}
        });
        answer4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try{
                if (!currentDef.equals("")){
                    if (firstGuess.equals("")){
                        firstGuess=answer4.getText().toString();
                    }
                    currentAnswer=answer4.getText().toString();
                    if (currentAnswer.equals(correctAnswer)){
                        notify.setTextColor(Color.GREEN);
                        notify.setText("Correct Answer");
                    }else {
                        notify.setTextColor(Color.RED);//https://stackoverflow.com/questions/4602902/how-to-set-the-text-color-of-textview-in-code
                        notify.setText("Incorrect Answer");
                    }
                }
            }catch (Exception e){
                    Log.e("Error on button push: ", e.getMessage());
                }}
        });
        //button for next questions
    nextQ.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View view) {
            ArrayList<String> questionAnswers= new ArrayList<String>();//resets the array list the buttons
            try {
                if (firstGuess.equals(correctAnswer)){
                    score=score+1;// if the users first guess was the correct one give them a point
                }
                if (!definitions.isEmpty()) {// if the list is not empty

                    firstGuess="";//reset first guess for next question
                    notify.setText("");//reset the notification to nothing
                    Collections.shuffle(answers);//shuffle the answers
                    nextQ.setText("Next Question");// sets the button from submit to next question
                    currentDef = definitions.get(0);//grabs the first thing in definitions list
                    correctAnswer = hashes.get(currentDef);//grabs correct answer for the definition
                    //incorrect answers
                    as1 = answers.get(0);
                    as2 = answers.get(1);
                    as3 = answers.get(2);

                    //checks if the incorrect answers are the correct answer and changed them if they are
                    if (checkDupes.checkDuplicate(as1, correctAnswer)) {
                        as1 = answers.get(3);
                    } else if (checkDupes.checkDuplicate(as2, correctAnswer)) {
                        as2 = answers.get(3);
                    } else if (checkDupes.checkDuplicate(as3, correctAnswer)) {
                        as3 = answers.get(3);
                    }
                    //adds all answers to list
                    questionAnswers.add(correctAnswer);
                    questionAnswers.add(as1);
                    questionAnswers.add(as2);
                    questionAnswers.add(as3);
                    //shuffles list
                    Collections.shuffle(questionAnswers);
                    //sets textview
                    def.setText(currentDef);
                    //sets button
                    answer1.setText(questionAnswers.get(0));
                    answer2.setText(questionAnswers.get(1));
                    answer3.setText(questionAnswers.get(2));
                    answer4.setText(questionAnswers.get(3));
                    //remove definition from list
                    definitions.remove(0);

                    //if definitions is empty make the bottom next page button to see results
                    if (definitions.isEmpty()){
                        nextQ.setText("See Results");
                    }
                    //resets current answer
                    currentAnswer="";
                }else {
                    // if the quiz is over
                    //send name, score, and total questions asked to a new page
                    Intent resultsPage= new Intent(questions.this, results.class);
                    resultsPage.putExtra("userName",editName.getString("userName"));
                    resultsPage.putExtra("userScore",score);
                    resultsPage.putExtra("questionAmt",quizLength);
                    //load new page
                    startActivity(resultsPage);
                }
            }catch (Exception e){//error logging to tell me if it had to do with getting next question
                Log.e("Error getting next question: ", e.getMessage());
            }

        }
    });

    }
}
