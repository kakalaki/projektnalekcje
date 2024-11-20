x = input("Ile masz kasy? ")
y = input("Jaki jest bet ")

print(x, y)

while float(x) >= 0:
    win = input("Ile wygrales? (nic zostaw puste) ")
    if win == "":
        win = "0"
    x=float(x)+float(win)-float(y)
    print("Stan konta", x, " (mnożnik ",float(win)/float(y),"x)")

print("przegrales kase")
