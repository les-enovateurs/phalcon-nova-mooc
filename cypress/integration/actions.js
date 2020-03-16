describe('Check features of NovaMooc', function() {

    beforeEach(function () {
        cy.visit('/')

        cy.get(":input[name='email']")
            .type(Cypress.env( 'user1' ))
            .should('have.value', Cypress.env('user1'));

        cy.get(":input[name='password']")
            .type(Cypress.env( 'password1' ))
            .should('have.value', Cypress.env('password1'));

        cy.get("#submit_button").click();

        cy.title().should('include', 'NovaMooc - Dashboard')
        cy.url().should('include', '/teacher')
    });

    afterEach(function () {
        cy.get("a[href='/logout']").click()
    });

    context('Update a Course', function () {
        it('Update a Course', function() {
            cy.get("a[href*='/course/update']").click()

            cy.title().should('include', 'NovaMooc - Update a course')
            cy.url().should('contains', '/course/update')

            cy.get(":input[name='title']")
                .type(' test update')
                .should('have.value', 'Phalcon 3 test update');

            cy.get(":input[name='description']")
                .type(' test update')
                .should('have.value', 'Develop complex and powerful web applications in PHP. test update');

            cy.get("input[type='submit']").click();

            cy.title().should('include', 'NovaMooc - Dashboard')
            cy.url().should('include', '/teacher')

            cy.contains('Phalcon 3 test update')
            cy.contains('Develop complex and powerful web applications in PHP. test update')
        })
    })

    context('Create a new course', function () {
        it('Create a new course', function() {
            cy.get("a[href*='/course/new']").click()

            cy.title().should('include', 'NovaMooc - New course')
            cy.url().should('contains', '/course/new')

            let title = 'An awesome course';
            let description = 'You will learn a lot of amazing things';

            cy.get(":input[name='title']")
                .type(title)
                .should('have.value', title);

            cy.get(":input[name='description']")
                .type(description)
                .should('have.value', description);

            cy.get("input[type='submit']").click();

            cy.title().should('include', 'NovaMooc - Dashboard')
            cy.url().should('include', '/teacher')

            cy.contains(title)
            cy.contains(description)
        })
    })

    context('Delete the new course', function () {
        it('Delete the new course', function() {
            cy.get("a[href='/course/delete/1']").click()

            cy.title().should('include', 'NovaMooc - Dashboard')
            cy.url().should('include', '/teacher')

            cy.get('.container').find('.card').should('have.length',2);
        })
    })
})
