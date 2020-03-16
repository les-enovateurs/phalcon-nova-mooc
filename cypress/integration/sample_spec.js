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
            cy.get("#submit_button").click()
        })

        it('Check Dashboard', function() {
            cy.title().should('include', 'NovaMooc - Dashboard')
            cy.url().should('include', '/teacher')
        })

        it('Logout', function() {
            cy.get("a[href='/logout']").click()
        })
    })

    context('CRUD Course', function () {
        it('Visit the home page', function() {
            cy.visit('/')
        })

        it('Type email and password to connect', function() {
            cy.get(":input[name='email']")
                .type('louise.doe@les-enovateurs.com')
                .should('have.value', 'louise.doe@les-enovateurs.com')

            cy.get(":input[name='password']")
                .type('uiopq')
                .should('have.value', 'uiopq')
        })

        it('Connect', function() {
            cy.get("#submit_button").click()
        })

        it('Check Dashboard', function() {
            cy.title().should('include', 'NovaMooc - Dashboard')
            cy.url().should('include', '/teacher')
        })

        it('Update course', function() {
            cy.wait(500)
            cy.get("a[href*='/course/update']").click()
        })

        it('Add new course', function() {
            cy.get("a[href='/course/new']").click()
        })

        it('Check new course', function() {
            cy.title().should('include', 'NovaMooc - New course')
            cy.url().should('include', '/course/new')
        })
    })
})
