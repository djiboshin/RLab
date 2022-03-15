import pyvisa
import sys
resurse = sys.argv[1]
cmd = sys.argv[2]
rm = pyvisa.ResourceManager()
#'USB0::0xF4ED::0xEE3A::NDG10GAQ3R0226::INSTR'
inst = rm.open_resource(resurse)
try:
    inst.query(cmd)
except:
    pass
#"*IDN?"
