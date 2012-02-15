[{cms_script}](http://dev.cmsmadesimple.org/projects/cms_script) - Smaller is better
==================================================

What the fu*k is that ?
--------------------------------------

{cms_script} est un module qui tente de répondre au besoin croissant des webmasters de réduire l'impact du Javascript dans le chargement des pages web. Voici quelques besoins exprimés pour lesquels {cms_script} peut vous aider

1. Externaliser le javascript habituellement présent dans les pages HTML de votre site vers un fichier externe
2. Combiner différentes portions de JS en un seul bloc de code
3. Appliquer des traitements de minification au code Javascript afin de réduire le poids total nécessaire
4. Définir une url d'accès alternative (ex : http://static.ndd.tld ) afin de bénéficier d'amélioration de perf d'un CDN et du parallélisme habituellement limité des requêtes HTTP dans les navigateurs
5. Déclencher le chargement des scripts APRES le chargement de votre page afin de réduire le temps nécessaire à votre site pour s'afficher sur le poste client

Directement ou indirectement, les gains sont très importants :

- Réduction de la bande passante utilisée (le code JS pouvant enfin être mis en cache par le navigateur)
- Amélioration des best-practices en excluant le code JS de vos pages
- Accélération du rendu client (chargement asynchrone des scripts, moins de données à charger sur le réseau)
