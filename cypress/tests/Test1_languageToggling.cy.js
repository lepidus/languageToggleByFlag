describe('Language Toggle by Flag - Toggle of language', function() {
	it('Sets plugin to display at sidebar', function() {
        cy.login('dbarnes', null, 'publicknowledge');
		cy.contains('a', 'Website').click();
        
        cy.contains('button', 'Appearance').click();
        cy.get('#appearance-setup-button').click();
        cy.get('span', 'Language Toggle by Flag').parent().within(() => {
            cy.get('input[name="sidebar"]').check();
        });
        cy.get('#appearance-setup button:contains("Save")').click();
        cy.contains('.pkpFormPage__status', 'Saved');
    });
});