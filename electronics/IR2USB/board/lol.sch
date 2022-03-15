EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title ""
Date ""
Rev ""
Comp ""
Comment1 ""
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L Transistor_FET:2N7000 Q2
U 1 1 5F340E59
P 5350 1950
F 0 "Q2" H 5554 1996 50  0000 L CNN
F 1 "2N7000" H 5554 1905 50  0000 L CNN
F 2 "Package_TO_SOT_THT:TO-92_Inline" H 5550 1875 50  0001 L CIN
F 3 "https://www.fairchildsemi.com/datasheets/2N/2N7000.pdf" H 5350 1950 50  0001 L CNN
	1    5350 1950
	1    0    0    -1  
$EndComp
$Comp
L Transistor_FET:2N7000 Q1
U 1 1 5F3415EF
P 4650 1950
F 0 "Q1" H 4854 1996 50  0000 L CNN
F 1 "2N7000" H 4854 1905 50  0000 L CNN
F 2 "Package_TO_SOT_THT:TO-92_Inline" H 4850 1875 50  0001 L CIN
F 3 "https://www.fairchildsemi.com/datasheets/2N/2N7000.pdf" H 4650 1950 50  0001 L CNN
	1    4650 1950
	1    0    0    -1  
$EndComp
$Comp
L Device:R R2
U 1 1 5F342A8F
P 4750 1550
F 0 "R2" H 4820 1596 50  0000 L CNN
F 1 "4700" H 4820 1505 50  0000 L CNN
F 2 "Resistor_THT:R_Axial_DIN0411_L9.9mm_D3.6mm_P12.70mm_Horizontal" V 4680 1550 50  0001 C CNN
F 3 "~" H 4750 1550 50  0001 C CNN
	1    4750 1550
	1    0    0    -1  
$EndComp
$Comp
L Device:R R3
U 1 1 5F3432B5
P 5450 1550
F 0 "R3" H 5520 1596 50  0000 L CNN
F 1 "4700" H 5520 1505 50  0000 L CNN
F 2 "Resistor_THT:R_Axial_DIN0411_L9.9mm_D3.6mm_P12.70mm_Horizontal" V 5380 1550 50  0001 C CNN
F 3 "~" H 5450 1550 50  0001 C CNN
	1    5450 1550
	1    0    0    -1  
$EndComp
$Comp
L Device:R R1
U 1 1 5F343A28
P 4150 1550
F 0 "R1" H 4220 1596 50  0000 L CNN
F 1 "680" H 4220 1505 50  0000 L CNN
F 2 "Resistor_THT:R_Axial_DIN0411_L9.9mm_D3.6mm_P12.70mm_Horizontal" V 4080 1550 50  0001 C CNN
F 3 "~" H 4150 1550 50  0001 C CNN
	1    4150 1550
	1    0    0    -1  
$EndComp
Wire Wire Line
	5450 1700 5450 1750
Wire Wire Line
	4750 1750 4750 1700
Wire Wire Line
	4750 1750 5150 1750
Wire Wire Line
	5150 1750 5150 1950
Connection ~ 4750 1750
Wire Wire Line
	4150 1400 4750 1400
Connection ~ 4750 1400
Wire Wire Line
	4750 1400 5450 1400
$Comp
L Device:D_Photo D1
U 1 1 5F345D52
P 4150 2050
F 0 "D1" V 4054 1970 50  0000 R CNN
F 1 "D_Photo" V 4145 1970 50  0000 R CNN
F 2 "OptoDevice:R_LDR_4.9x4.2mm_P2.54mm_Vertical" H 4100 2050 50  0001 C CNN
F 3 "~" H 4100 2050 50  0001 C CNN
	1    4150 2050
	0    -1   1    0   
$EndComp
Wire Wire Line
	4150 1700 4150 1750
Wire Wire Line
	4150 2150 4750 2150
Connection ~ 4750 2150
Wire Wire Line
	4750 2150 5450 2150
Wire Wire Line
	4450 1950 4450 1750
Wire Wire Line
	4450 1750 4150 1750
Connection ~ 4150 1750
Wire Wire Line
	4150 1750 4150 1850
$Comp
L power:GND #PWR02
U 1 1 5F347D7E
P 5900 2150
F 0 "#PWR02" H 5900 1900 50  0001 C CNN
F 1 "GND" H 5905 1977 50  0000 C CNN
F 2 "" H 5900 2150 50  0001 C CNN
F 3 "" H 5900 2150 50  0001 C CNN
	1    5900 2150
	1    0    0    -1  
$EndComp
$Comp
L power:+3.3V #PWR01
U 1 1 5F348580
P 5900 1400
F 0 "#PWR01" H 5900 1250 50  0001 C CNN
F 1 "+3.3V" H 5915 1573 50  0000 C CNN
F 2 "" H 5900 1400 50  0001 C CNN
F 3 "" H 5900 1400 50  0001 C CNN
	1    5900 1400
	1    0    0    -1  
$EndComp
Wire Wire Line
	5900 1400 5450 1400
Connection ~ 5450 1400
Wire Wire Line
	5450 2150 5900 2150
Connection ~ 5450 2150
Wire Wire Line
	6150 1400 5900 1400
Connection ~ 5900 1400
Wire Wire Line
	6150 2150 5900 2150
Connection ~ 5900 2150
Wire Wire Line
	6150 1750 5450 1750
Connection ~ 5450 1750
$Comp
L Connector:Conn_01x03_Female J1
U 1 1 5F34CEDB
P 6350 1750
F 0 "J1" H 6378 1776 50  0000 L CNN
F 1 "Conn_01x03_Female" H 6378 1685 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x03_P2.54mm_Vertical" H 6350 1750 50  0001 C CNN
F 3 "~" H 6350 1750 50  0001 C CNN
	1    6350 1750
	1    0    0    -1  
$EndComp
Wire Wire Line
	6150 1400 6150 1650
Wire Wire Line
	6150 1850 6150 2150
$EndSCHEMATC
