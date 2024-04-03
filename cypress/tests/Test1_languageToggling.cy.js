describe('Language Toggle by Flag - Toggle of language', function() {
	it('Sets plugin to display at sidebar', function() {
        cy.login('dbarnes', null, 'publicknowledge');
		cy.contains('a', 'Website').click();
        
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
            cy.contains('Français');
        });

        cy.contains('strong', 'English').prev().should('have.css', 'background-image');
        cy.contains('strong', 'English').parent().parent().should('have.class', 'current');
        cy.contains('a', 'Français').click();

        cy.contains('strong', 'Français').prev().should('have.css', 'background-image');
        cy.contains('strong', 'Français').parent().parent().should('have.class', 'current');
    });
});