describe('Check feature of NovaMooc', function() {
    context('Visit the home page', function () {
        it('Visit the home page', function() {
            cy.visit('/')
        })
    })
    context('Connect to NovaMooc', function () {
        it('Visit the home page', function() {
            cy.visit('/')
        })

        it('Type email and password to connect', function() {
            cy.get(":input[name='email']")
            .type('john.doe@les-enovateurs.com')
            .should('have.value', 'john.doe@les-enovateurs.com')
    
            cy.get(":input[name='password']")
            .type('azerty')
            .should('have.value', 'azerty')
        })
    
        it('Connect', function() {
            cy.get("#bouton_de_soumission").click()
        })
    })
})