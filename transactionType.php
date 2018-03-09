<?php 

if($transactionType == 'addMoney')
	    {
	     	$senderType = 0;
	     	$actionType = 'credit';
	    } 	    
	    elseif($transactionType == 'withdrawMoney')
	    {
	    	$senderType = 0;
	    	$actionType = 'debit';
	    }
	    elseif($transactionType == 'paymoney')
	    {
	      	$senderType = 4;
	     	$actionType = 'debit';
	    }
	    elseif($transactionType == 'acceptmoney')
	    {
	     	$senderType = 4;
	    	 $actionType = 'credit';
	    }
	    elseif($transactionType == 'shop')
	    {
	     $senderType = 2;
	     $actionType = 'debit';
	    }elseif($transactionType == 'wwdebit'){
	     $senderType = array(1,2,3,4,5);
	     $actionType = array('debit');
	    }elseif($transactionType == 'wwcredit'){
	     $senderType = array(1,2,3,4,5);
	     $actionType = array('credit');
	    }elseif($transactionType == 'ewcreditdebit'){
	     $senderType = array(0=>0);
	     $actionType = array('credit','debit');
	    }else{
	     $senderType = array(0,1,2,3,4,5);
	     $actionType = array('credit','debit');
	    }
public static ArrayList<ColorCore> getAllColorsData() {

        ArrayList<ColorCore> allColors = new ArrayList<>();

        ColorCore core = new ColorCore();
        core.setId(49);
        core.setName("Black");


//        "" value="50"
        ColorCore core1 = new ColorCore();
        core1.setId(50);
        core1.setName("Blue");
//        "Brown" value="51"
        ColorCore core2 = new ColorCore();
        core2.setId(51);
        core2.setName("Brown");
//        "Gray" value="52"
        ColorCore core3 = new ColorCore();
        core3.setId(52);
        core3.setName("Gray");
//        "Green" value="53"
        ColorCore core4 = new ColorCore();
        core4.setId(53);
        core4.setName("Green");
//        "Lavender" value="54"
        ColorCore core5 = new ColorCore();
        core5.setId(54);
        core5.setName("Lavender");

//        "Multi" value="55"
        ColorCore core6 = new ColorCore();
        core6.setId(55);
        core6.setName("Multi");
//        "Orange" value="56"
        ColorCore core7 = new ColorCore();
        core7.setId(56);
        core7.setName("Orange");
//        "Purple" value="57"
        ColorCore core8 = new ColorCore();
        core8.setId(57);
        core8.setName("Purple");
//        "Red" value="58"
        ColorCore core9 = new ColorCore();
        core9.setId(58);
        core9.setName("Red");
//        "White" value="59"
        ColorCore core10 = new ColorCore();
        core10.setId(59);
        core10.setName("White");
//        "Yellow" value="60"
        ColorCore core11 = new ColorCore();
        core11.setId(60);
        core11.setName("Yellow");

        allColors.add(core);
        allColors.add(core1);
        allColors.add(core2);
        allColors.add(core3);
        allColors.add(core4);
        allColors.add(core5);
        allColors.add(core6);
        allColors.add(core7);
        allColors.add(core8);
        allColors.add(core9);
        allColors.add(core10);
        allColors.add(core11);
        return allColors;


    }

    public static ArrayList<ColorCore> getAllSizesData() {

        ArrayList<ColorCore> allColors = new ArrayList<>();
        //55 cm" value="91"


        ColorCore core = new ColorCore();
        core.setId(91);
        core.setName("55 cm");
        //"65 cm" value="92


        ColorCore core1 = new ColorCore();
        core1.setId(92);
        core1.setName("65 cm");
//75 cm" value="93


        ColorCore core2 = new ColorCore();
        core2.setId(93);
        core2.setName("75 cm");
//         6 foot" value="94


        ColorCore core3 = new ColorCore();
        core3.setId(94);
        core3.setName("6 foot");
//        8 foot" value="95


        ColorCore core4 = new ColorCore();
        core4.setId(95);
        core4.setName("8 foot");
//        10 foot" value="96


        ColorCore core5 = new ColorCore();
        core5.setId(96);
        core5.setName("10 foot");

//        XS" value="167


        ColorCore core6 = new ColorCore();
        core6.setId(167);
        core6.setName("XS");
//       S" value="168

        ColorCore core7 = new ColorCore();
        core7.setId(168);
        core7.setName("S");
//          M" value="169


        ColorCore core8 = new ColorCore();
        core8.setId(169);
        core8.setName(" M");
//          L" value="170"


        ColorCore core9 = new ColorCore();
        core9.setId(170);
        core9.setName("L");
//      XL" value="171


        ColorCore core10 = new ColorCore();
        core10.setId(171);
        core10.setName("XL");
//        28" value="172


        ColorCore core11 = new ColorCore();
        core11.setId(172);
        core11.setName("28\"");


        //29" value="173
        ColorCore core12 = new ColorCore();
        core12.setId(173);
        core12.setName("29\"");
//        30" value="174
        ColorCore core13 = new ColorCore();
        core13.setId(174);
        core13.setName("30\"");
//        31" value="175
        ColorCore core14 = new ColorCore();
        core14.setId(175);
        core14.setName("31\"");
//        32" value="176
        ColorCore core15 = new ColorCore();
        core15.setId(176);
        core15.setName("32\"");
//        33" value="177
        ColorCore core16 = new ColorCore();
        core16.setId(177);
        core16.setName("33\"");
//        34" value="178
        ColorCore core17 = new ColorCore();
        core17.setId(178);
        core17.setName("34\"");
//        36" value="179
        ColorCore core18 = new ColorCore();
        core18.setId(179);
        core18.setName("36\"");
//        38" value="180
        ColorCore core19 = new ColorCore();
        core19.setId(180);
        core19.setName("38\"");


        allColors.add(core);
        allColors.add(core1);
        allColors.add(core2);
        allColors.add(core3);
        allColors.add(core4);
        allColors.add(core5);
        allColors.add(core6);
        allColors.add(core7);
        allColors.add(core8);
        allColors.add(core9);
        allColors.add(core10);
        allColors.add(core11);


        allColors.add(core12);
        allColors.add(core13);
        allColors.add(core14);
        allColors.add(core15);
        allColors.add(core16);
        allColors.add(core17);
        allColors.add(core18);
        allColors.add(core19);

        return allColors;


    }		

"Black" value="49"
"Blue" value="50"
"Brown" value="51"
"Gray" value="52"
"Green" value="53"
"Lavender" value="54"
"Multi" value="55"
"Orange" value="56"
"Purple" value="57"
"Red" value="58"
"White" value="59"
"Yellow" value="60"


"55 cm" value="91"
"XS" value="167"
"65 cm" value="92
S" value="168
75 cm" value="93
M" value="169
6 foot" value="94
L" value="170">
 8 foot" value="95
XL" value="171
10 foot" value="96
28" value="172
29" value="173
30" value="174
31" value="175
32" value="176
33" value="177
34" value="178
36" value="179
38" value="180