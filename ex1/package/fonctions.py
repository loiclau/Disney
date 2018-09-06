#/usr/bin/python3
# -*- coding: utf-8 -*-

"""module fonctions contenant la fonction table"""

def table(nb, max = 10):
    """fonction affichant la table de multiplication par nb de
    1 * nb a max * nb"""

    i = 0
    while i < max:
        print (i+1, "*", nb, "=", (i + 1) * nb)

        i +=1

# test de la fonction table
if __name__ == "__main__":
    table(4)
