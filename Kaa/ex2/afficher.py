#/usr/bin/python3
# -*- coding: utf-8 -*-

def afficher(*values, sep=' ', fin='\n'):
    params = list(value)
    for i , param in enumerate(params):
        pareams[i] = str(param)

    chaine = sep.join(params)
    chaine += fin
    print(chaine, end='')