package com.example.calculator;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;


public class MainActivity extends AppCompatActivity {
    Calc calc= new Calc();
    TextView display;
    Button zero;
    Button one;
    Button two;
    Button three;
    Button four;
    Button five;
    Button six;
    Button seven;
    Button eight;
    Button nine;
    Button plus;
    Button minus;
    Button equals;
    Button multiply;
    Button divide;
    Button clear;
    Button backspace;
    Button posneg;
    Button decimal;

    String leftnum="";
    String rightnum="";
    String op="";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        backspace=findViewById(R.id.backspace);
        clear=findViewById(R.id.clear);
        display = findViewById(R.id.tv);

        posneg=findViewById(R.id.posneg);
        decimal=findViewById(R.id.decimal);

        plus=findViewById(R.id.plus);
        minus=findViewById(R.id.minus);
        multiply=findViewById(R.id.multiply);
        divide=findViewById(R.id.divide);
        equals=findViewById(R.id.equals);

        zero=findViewById(R.id.zero);
        one=findViewById(R.id.one);
        two=findViewById(R.id.two);
        three=findViewById(R.id.three);
        four=findViewById(R.id.four);
        five=findViewById(R.id.five);
        six=findViewById(R.id.six);
        seven=findViewById(R.id.seven);
        eight=findViewById(R.id.eight);
        nine=findViewById(R.id.nine);

        zero.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"0";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"0";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        one.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"1";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"1";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        two.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"2";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"2";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        three.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"3";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"3";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        four.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"4";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"4";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        five.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"5";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"5";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        six.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"6";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"6";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        seven.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"7";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"7";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        eight.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"8";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"8";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        nine.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op==""){
                    leftnum= leftnum+"9";
                    display.setText(leftnum+op+rightnum);
                }
                else if (op!=""){
                    rightnum=rightnum+"9";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        backspace.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (leftnum=="NaN"){//clears everything if there is a NaN
                    leftnum="";
                    op="";
                    rightnum="";
                }
                else if (op=="" &&leftnum.contains("-") == true && leftnum.length()==2){leftnum="";}
                else if (op=="" && leftnum.length()!=0){// checks if the string is empty
                    leftnum=leftnum.replaceAll(".$","");
                    if (leftnum.length()==0){// regex will throw a hidden character onto the end of a string so if the string is empty just reset it
                        leftnum="";
                    }

                }
                else if (op!="" &&rightnum.contains("-") == true && rightnum.length()==2){rightnum="";}
                else if (op!="" && rightnum=="" && op.length()!=0){
                    op=op.replaceAll("[/*+.-]$","");
                    if (op.length()==0){
                        op="";
                    }
                }
                else if (op!="" && rightnum.length()!=0){
                    rightnum=rightnum.replaceAll(".$","");
                    if (rightnum.length()==0){
                        rightnum="";
                    }
                }
                display.setText(leftnum + op + rightnum);
            }
        });
        clear.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum="";
                rightnum="";
                op="";
                display.setText(leftnum + op + rightnum);
            }
        });
        posneg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                //https://www.guru99.com/string-contains-method-java.html
                    leftnum=calc.isNaN(leftnum);
                    if (leftnum != "") {// aslong as the number is not empty
                        if (Double.parseDouble(leftnum)==0){}
                        else if (op == "" && leftnum.contains("-") == false) {//checks if there is already a negative sign or not
                            leftnum = "-" + leftnum;
                            display.setText(leftnum + op + rightnum);
                        } else if (op == "" && leftnum.contains("-") == true) {
                            leftnum = leftnum.replace("-", "");
                            display.setText(leftnum + op + rightnum);
                        }
                    }
                    if (rightnum!=""){
                        if (Double.parseDouble(rightnum)==0){}
                        if (op != "" && rightnum.contains("-") == false) {
                            rightnum = "-" + rightnum;
                            display.setText(leftnum + op + rightnum);
                    }
                        else if (op != "" && rightnum.contains("-") == true) {
                            rightnum = rightnum.replace("-", "");
                            display.setText(leftnum + op + rightnum);
                    }
                }

            }
            });
        decimal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                {//https://www.guru99.com/string-contains-method-java.html
                    leftnum=calc.isNaN(leftnum);
                    if (op == "" && leftnum=="") {//checks if there is already a negative sign or not
                        leftnum = leftnum+"0."  ;
                        display.setText(leftnum + op + rightnum);
                    }

                    else if (op != ""&& rightnum=="") {
                        rightnum =  rightnum+"0.";
                        display.setText(leftnum + op + rightnum);
                    }
                    else if (op == "" && leftnum.contains(".")==false) {//checks if there is already a negative sign or not
                        leftnum = leftnum+"."  ;
                        display.setText(leftnum + op + rightnum);
                    }

                    else if (op != ""&& rightnum.contains(".")==false) {
                        rightnum =  rightnum+".";
                        display.setText(leftnum + op + rightnum);
                    }


                }
            }
        });
        plus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);

                if (op!=""&& rightnum!=""){
                    leftnum=calc.Calculate(leftnum,rightnum,op);
                    rightnum="";
                    op="+";
                    display.setText(leftnum+op+rightnum);
                }
                else if (rightnum!="" ){//dont want it to do anything if it rightnum equals 0
                }
                else if (leftnum!=""&& leftnum !="-"){
                    op="+";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        minus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op!=""&& rightnum!=""){
                    leftnum=calc.Calculate(leftnum,rightnum,op);
                    rightnum="";
                    op="-";
                    display.setText(leftnum+op+rightnum);

                }
                else if (rightnum!="" ){//dont want it to do anything if it rightnum equals 0

                }
                else if (leftnum!=""&& leftnum !="-"){
                    op="-";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        multiply.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op!=""&& rightnum!=""){
                    leftnum=calc.Calculate(leftnum,rightnum,op);
                    rightnum="";
                    op="*";
                    display.setText(leftnum+op+rightnum);

                }
                else if (rightnum!="" ){//dont want it to do anything if it rightnum equals 0

                }
                else if (leftnum!=""&& leftnum !="-"){
                    op="*";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        divide.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (op!="" && rightnum!="" && rightnum!="-" && rightnum!= "."){
                    leftnum=calc.Calculate(leftnum,rightnum,op);
                    rightnum="";
                    op="/";
                    display.setText(leftnum+op+rightnum);

                }
                else if (rightnum!=""){

                }
                else if (leftnum!=""&& leftnum!="-" && leftnum!= "."){
                    op="/";
                    display.setText(leftnum+op+rightnum);
                }
            }
        });
        equals.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                leftnum=calc.isNaN(leftnum);
                if (leftnum!="" && rightnum != "" && op!= "") {
                    leftnum = calc.Calculate(leftnum, rightnum, op);
                    rightnum = "";
                    op = "";
                    display.setText(leftnum + op + rightnum);
                }
                }

        });
    }

}