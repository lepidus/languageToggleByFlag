describe('Language Toggle by Flag - Plugin enabling and setup', function() {
	it('Enables plugin', function() {
		cy.login('dbarnes', null, 'publicknowledge');
		cy.contains('a', 'Website').click();

		cy.waitJQuery();
		cy.get('#plugins-button').click();

		cy.get('input[id^=select-cell-languagetogglebyflagplugin]').check();
		cy.get('input[id^=select-cell-languagetogglebyflagplugin]').should('be.checked');
	});
});