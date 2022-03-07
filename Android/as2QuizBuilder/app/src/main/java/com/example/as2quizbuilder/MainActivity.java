package com.example.as2quizbuilder;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    //initializing
    Button submit;
    EditText name;
    TextView errorName;
    String innerText;
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //hooking up the buttons, and  text views
        submit=findViewById(R.id.enterName);
        name= findViewById(R.id.editTextPersonName);
        //error text view
        errorName=findViewById(R.id.errorName);
        //submit button
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                innerText=name.getText().toString();// grabs text in string
                if (innerText.equals(""))//if it is empty
                {
                    errorName.setText("Name is empty please, enter a name");// tell user and do not let them continue until they enter name

                }else{
                    Intent qPage= new Intent(MainActivity.this, questions.class);//the questions page
                    qPage.putExtra("userName",innerText);//give the name to the questions page

                    startActivity(qPage);// go to questions.java
                }}
            });
    }
}