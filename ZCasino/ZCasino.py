#/usr/bin/python3
# -*- coding: utf-8 -*-

from random import randrange
from math import ceil

money = 200
next_turn = True

print("Vous avez ", money, "$")

while next_turn:
    #Verification du nombre sur lequel parier
    pari = -1
    while pari > 49 or pari < 0:
        pari = input('Sur quel nombre misez vous? (entre 0 et 49)')
        try:
            pari = int(pari)
        except ValueError:
            print('Ce n est pas un nombre')
            pari = -1
        if pari > 49 or pari < 0:
            print('Ce n est pas un nombre entre 0 et 49')

    mise = 0
    while mise < 1 or mise > money:
        mise = input('Combien voulez vous parier?')
        try:
            mise = int(mise)
        except ValueError:
            print('Ce n est pas un nombre')
            mise = -1
        if mise > money:
            print('Vous n\'avez pas assé d\'argent')
        elif mise < 0:
            print('Vous devez parier de l\'argent')

    # les input sont valide.
    numero = randrange(50)
    print('Le numero gagnant est :', numero)
    if numero == pari:
        gain = 3 * mise
        print('Bravo, vous avez gagné :', gain)
    elif numero % 2 == pari % 2:
        gain = ceil(mise / 2)
        print('Bravo, vous avez la bonne couleur, vous avez gagné :', gain)
    else:
        gain = mise * -1
        print('Vous avez perdu')

    money += gain
    if money <= 0:
        print('Vous n\'avez plus d\'argent')
        next_turn = False
    else:
        print("Vous avez ", money, "$")
        exit = input('continuer (o/n)?')

    if exit.lower() == 'n':
        print('Vous repartez avec ', money, '$')
        next_turn = False
