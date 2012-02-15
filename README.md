[{cms_script}](http://dev.cmsmadesimple.org/projects/cms_script) - Smaller is better
==================================================

What the fu*k is that ?
--------------------------------------

{cms_script} est un module qui tente de r�pondre au besoin croissant des webmasters de r�duire l'impact du Javascript dans le chargement des pages web. Voici quelques besoins exprim�s pour lesquels {cms_script} peut vous aider

1. Externaliser le javascript habituellement pr�sent dans les pages HTML de votre site vers un fichier externe
2. Combiner diff�rentes portions de JS en un seul bloc de code
3. Appliquer des traitements de minification au code Javascript afin de r�duire le poids total n�cessaire
4. D�finir une url d'acc�s alternative (ex : http://static.ndd.tld ) afin de b�n�ficier d'am�lioration de perf d'un CDN et du parall�lisme habituellement limit� des requ�tes HTTP dans les navigateurs
5. D�clencher le chargement des scripts APRES le chargement de votre page afin de r�duire le temps n�cessaire � votre site pour s'afficher sur le poste client

Directement ou indirectement, les gains sont tr�s importants :

- R�duction de la bande passante utilis�e (le code JS pouvant enfin �tre mis en cache par le navigateur)
- Am�lioration des best-practices en excluant le code JS de vos pages
- Acc�l�ration du rendu client (chargement asynchrone des scripts, moins de donn�es � charger sur le r�seau)
