#/usr/bin/python3
# -*- coding: utf-8 -*-

def afficher_flottant(nb):
    if type(nb) is not float:
        raise TypeError('le nombre doit etre un float')
    nb = str(nb)
    entier, decimal = nb.split('.')

    #return entier + ',' +decimal[:3]
    return ",".join((entier, decimal[:3]))

entree = float(input('donnez un float : '))
retour = afficher_flottant(entree)
print(retour)
