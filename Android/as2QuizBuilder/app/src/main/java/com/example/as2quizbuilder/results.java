package com.example.as2quizbuilder;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class results extends AppCompatActivity {
    //initializing
    Button tryAgain;
    TextView result;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_results);
        //hooking up variables
        tryAgain=findViewById(R.id.tryAgainBtn);
        result=findViewById(R.id.scoring);
        //grabs stuff from the bundle on questions.java
        Bundle results=getIntent().getExtras();
        String name=results.getString("userName");
        int score=results.getInt("userScore");
        int quizLength= results.getInt("questionAmt");
        //set the text to be your name score and amount of questions
        result.setText(name+", You Scored "+score+"/"+quizLength);
        tryAgain.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //button for reseting the program and take the quiz again.
                Intent restart= new Intent(results.this, MainActivity.class);
                startActivity(restart);
            }
        });
    }
}