describe('Check feature of NovaMooc', function() {
    context('Visit the home page', function () {
        it('Visit the home page', function() {
            cy.visit('/')
        })
    })
    context('Connect to NovaMooc', function () {
        it('Visit the home page', function() {
            cy.visit('/')

            cy.get(":input[name='email']")
            .type('john.doe@les-enovateurs.com')
            .should('have.value', 'john.doe@les-enovateurs.com')

            cy.get(":input[name='mot_de_passe']")
            .type('azerty')
            .should('have.value', 'azerty')
        })
    })
})