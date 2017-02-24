# Pull base image.
FROM node:7.5.0-alpine

# Create app directory
RUN mkdir -p /app
WORKDIR /app

# Copy our custom package.json inside of workdir and install node dependencies.
COPY . /app
RUN npm install

# Start the server.
CMD ["npm", "start"]
