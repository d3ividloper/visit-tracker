FROM node:22-alpine

WORKDIR /app

COPY ta-fe/package*.json ./

RUN npm install

COPY ta-fe/ .

CMD ["npm", "run", "dev", "--", "--host"]