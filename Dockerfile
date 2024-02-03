FROM node:18

WORKDIR var/www/

COPY package*.jsom ./

run npm install