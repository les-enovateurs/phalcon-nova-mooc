describe('Check API NovaMooc', function() {
    context('Check API', function(){
        it('Check the connection between FrontEnd and API', function(){
            cy.visit('/health')
            cy.contains('100% ready to take down the stars!')
        });

        it('Check API Doc', function(){
            cy.visit('http://localhost:8080')
        });
    });
});