FROM node:18

WORKDIR var/www/

COPY package*.jsom ./

run npm install

COPY . .

ENV PORT=8000

EXPOSE 8080

CMD ["node", "."]