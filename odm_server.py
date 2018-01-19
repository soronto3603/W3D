#!/usr/bin/python

from socket import *
from time import ctime
import os

HOST = '127.0.0.1'
PORT = 7675
BUFSIZ = 1024
ADDR = (HOST, PORT)

tcpSerSock = socket(AF_INET, SOCK_STREAM)
tcpSerSock.bind(ADDR)
tcpSerSock.listen(5)

while True:
    print 'waiting for connection...'
    tcpCliSock, addr = tcpSerSock.accept()
    print '...connected from:', addr

    while True:
        data = tcpCliSock.recv(BUFSIZ)
        if not data:
            break
        tcpCliSock.send('[%s] %s' % (ctime(), data))
        os.system("python /home/soronto/OpenDroneMap/run.py -i /var/www/html/w3d/odm_project/test test")
    tcpCliSock.close()
tcpSerSock.close()
