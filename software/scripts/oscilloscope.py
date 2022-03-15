import serial
import sys
port = sys.argv[1]
cmd = sys.argv[2]
try:
    ser = serial.Serial(port, baudrate=9600, bytesize=8, parity ='N', stopbits=1, xonxoff=False, dsrdtr=False, timeout = 2)
    if '?' in cmd:
        ser.write(str.encode(cmd + '\n'))
        print(ser.readline())
    else:
        ser.write(str.encode(cmd + '\n'))
    ser.close()
except:
    print('error')

