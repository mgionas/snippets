# Use your custom Docker Hub image as the base
FROM gnaskdiashvili/laravelvueinertia

# Copy the snippets directory to the container
COPY snippets /var/www/snippets

# Expose ports 8000 and 3000 for access to the services
EXPOSE 8000 3000

# Start Apache and run npm in the CMD command to ensure they're executed when the container starts.
# Apache needs to run in the background, npm run dev will be the main process.
CMD service apache2 start && \
    cd /var/www/snippets && \
    npm run dev -- --host 0.0.0.0 --port 3000
