#include <AccelStepper.h>

const int MAX_COORD = 230;   //максимальная координата в мм
const int STEPS_PER_MM = 200; //чему равен 1мм в шагах

int Relay1 = 2;  //пины реле
int Relay2 = 3;
int Relay3 = 4;
int Relay4 = 5;

int startRelay = 9;

String strData = "";  //вспомогательно для чтения команд
boolean recievedFlag;  //вспомогательно для чтения команд

int CurrentCapacity1 = 1;
int CurrentCapacity2 = 1;

AccelStepper stepper(1,7,6);

void setup() {
  Serial.begin(9600);
  Serial.setTimeout(200);
  
  stepper.setEnablePin(8);
  stepper.setPinsInverted(false, false, true);
  
  stepper.setMaxSpeed(10000);
  stepper.setAcceleration(13000);
  
  pinMode(Relay1, OUTPUT); //реле
  pinMode(Relay2, OUTPUT); //реле
  pinMode(Relay3, OUTPUT); //реле
  pinMode(Relay4, OUTPUT); //реле

  pinMode(startRelay, OUTPUT);
  
  pinMode(A0, INPUT); //концевик

  //Music();
  Home();
  SetCapacitor(1);

  Serial.println("ready");
}

void loop() {
  while (Serial.available() > 0) {         // ПОКА есть что то на вход    
    strData += (char)Serial.read();        // забиваем строку принятыми данными
    recievedFlag = true;                   // поднять флаг что получили данные
    delay(2);                              // ЗАДЕРЖКА. Без неё работает некорректно!
  }
  
  strData.toLowerCase();
  strData.trim();
  
  if (recievedFlag) {                      // если данные получены
    recievedFlag = false;                  // опустить флаг
    if (strData == "home") {
      Home();
      Serial.println("done");
    }

    else if (strData == "getcoord") {
      Serial.println(-1 * stepper.currentPosition() / STEPS_PER_MM);
    }

    else if (strData == "getcapacity1") {
      Serial.println(CurrentCapacity1);
    }
    
    else if (strData == "getcapacity2") {
      Serial.println(CurrentCapacity2);
    }
    
    else if (strData.substring(0,8) == "setcoord") {
      SetCoord(strData.substring(8).toFloat());
    }

    else if (strData.substring(0,11) == "setcapacity") {
      SetCapacitor(strData.substring(11).toInt());
    }
    
    else if (strData.substring(0,8) == "start") {
      digitalWrite(startRelay, HIGH);
      SetCoord(0);
    }
    
    else if (strData.substring(0,8) == "stop") {
      SetCoord(0);
      digitalWrite(startRelay, LOW);
    }
    
    else{
      Error();
    }
    
    strData = "";                          // очистить
    
  }
}


//Вывод ошибок
void Error() {
  Serial.println("error");
}


// Движение к нулю
void Home() {
  stepper.enableOutputs();
  if(digitalRead(A0) == HIGH) {
    while (digitalRead(A0) == HIGH){
      stepper.move(100);
      stepper.runSpeed();
      stepper.stop();
    }
  }
  stepper.stop();
  stepper.disableOutputs();
  stepper.setCurrentPosition(0);
}


//движение к координате
void SetCoord(float new_coord) {
  if (new_coord == 0){
    Home();
    Serial.println("done");
  }
  else if (0 > new_coord or  MAX_COORD < new_coord)
    Error();
  else{
    stepper.enableOutputs();
    stepper.runToNewPosition( - STEPS_PER_MM * new_coord);
    stepper.disableOutputs();
    Serial.println("done");
  }
}


//выбор конденсатора
void SetCapacitor(int i) {
  switch(i) {
    case 11:
      digitalWrite(Relay1, HIGH);
      digitalWrite(Relay2, HIGH);
      CurrentCapacity1 = 1;
      Serial.println("done");
      break;
    case 12:
      digitalWrite(Relay1, HIGH);
      digitalWrite(Relay2, LOW);
      Serial.println("done");
      CurrentCapacity1 = 2;
      break;
    case 13:
      digitalWrite(Relay1, LOW);
      digitalWrite(Relay2, LOW);
      Serial.println("done");
      CurrentCapacity1 = 3;
      break;
    case 21:
      digitalWrite(Relay3, HIGH);
      digitalWrite(Relay4, HIGH);
      CurrentCapacity2 = 1;
      Serial.println("done");
      break;
    case 22:
      digitalWrite(Relay3, HIGH);
      digitalWrite(Relay4, LOW);
      Serial.println("done");
      CurrentCapacity2 = 2;
      break;
    case 23:
      digitalWrite(Relay3, LOW);
      digitalWrite(Relay4, LOW);
      Serial.println("done");
      CurrentCapacity2 = 3;
      break;
    default:
      Error();
      break;
  }
}


//для музыки
void All(boolean cmd) {
  digitalWrite(Relay1, cmd);
  delay(50);
  digitalWrite(Relay2, cmd);
  delay(30);
  digitalWrite(Relay3, cmd);
  delay(10);
  digitalWrite(Relay4, cmd);
}


void Music() {
  All(HIGH);
  delay(500);
  All(LOW);
  delay(20);
  All(HIGH);
  delay(80);
  All(LOW);
  delay(20);
  All(HIGH);
  delay(80);
  All(LOW);
  delay(80);
  All(HIGH);
  delay(200);
  All(LOW);
  delay(200);
  All(HIGH);
  delay(200);
  All(LOW);
  delay(500);
  All(HIGH);
}
