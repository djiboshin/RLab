import serial
import sys
port = sys.argv[1]

unit = {'4': 10**-4,
        '1': 10**-3,
        '2': 10**-2,
        '3': 10**-1}
try:
    ser = serial.Serial(port, baudrate=2400, bytesize=8, parity ='N', stopbits=1, xonxoff=False, dsrdtr=False, timeout = 2)
    msg = ser.read_until(b'\r\n')
    ser.close()
    print(float(msg[0:5]) * unit[msg[6:7].decode()])
except:
    print('error')

