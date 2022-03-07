package com.example.calculator;

public class Calc {
    public String isNaN(String leftNum){
        if (leftNum=="NaN"){
            return "";
        }
        else{
            return leftNum;
        }
    }

    public String Calculate (String leftNum,String rightNum, String OP){
        double left = Double.parseDouble(leftNum);
        double right = Double.parseDouble(rightNum);

        double value=0;

         if (OP=="+"){
            value= left+right;
        }
        else if (OP=="-"){
            value= left-right;
        }
        if (OP=="*"){
            value= left*right;
        }
        else if (OP=="/"){
            if (right==0){

                return "NaN";
            }

            else {
                value = Math.ceil(1000* left / right) /1000;// rounding to nearest thousandths https://newbedev.com/javascript-round-to-the-nearest-hundredth-javascript-code-example
            }

        }



        return Double.toString(value);
    }


}
