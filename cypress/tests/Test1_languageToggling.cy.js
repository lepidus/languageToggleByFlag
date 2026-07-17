describe('Language Toggle by Flag - Toggle of language', function() {
	it('Sets plugin to display at sidebar', function() {
        cy.login('dbarnes', null, 'publicknowledge');

        cy.get('nav').contains('Settings').click();
        cy.get('nav').contains('Website').click({ force: true });

        cy.contains('button', 'Appearance').click();
        cy.get('#appearance-setup-button').click();
        
        cy.contains('span', 'Language Toggle by Flag').parent().within(() => {
            cy.get('input[name="sidebar"]').check();
        });
        cy.contains('span', 'Language Toggle Block').parent().within(() => {
            cy.get('input[name="sidebar"]').uncheck();
        });
        
        cy.get('#appearance-setup button:contains("Save")').click();
        cy.contains('.pkpFormPage__status', 'Saved');
    });
    it('Language toggle by flag is shown in public site', function () {
        cy.visit('');

        cy.get('.language_toggle_flag').within(() => {
            cy.contains('Language');
            cy.contains('English');
            cy.contains('français');
        });

        cy.contains('strong', 'English').prev().should('have.css', 'background-image');
        cy.contains('strong', 'English').parent().parent().should('have.class', 'current');
        cy.contains('a', 'français').click();

        cy.contains('strong', 'français').prev().should('have.css', 'background-image');
        cy.contains('strong', 'français').parent().parent().should('have.class', 'current');
    });
});