<?php
// TODO puts this in the database
function pfm_get_founders() {
  return [
    [
      'name'        => 'Cristina Olivotto',
      'picture'     => pfm_public_url('images/founders/cristina.jpg'),
      'description' => 'Cristina Olivotto (secrétaire), physicienne de formation,
      travaille depuis 15 ans dans le domaine de la communication et didactique formelle et informelle de la science.
      Elle a travaillé dans des organisations nationales et internationales en tant qu’indépendante depuis 2011.
      Elle a rejoint le comité de l’association en juin 2017 en qualité de secrétaire.
      Impliquée dans le monde du “Fais-le toi-même” elle remporte la troisième place du Prix IDDEA 2016 avec son projet “Makeshop”.'
    ],

    [
      'name'        => 'Mathieu Jacquesson',
      'picture'     => pfm_public_url('images/founders/mathieu.jpg'),
      'description' => 'Mathieu Jacquesson (président), économiste d’entreprise, cofondateur de l’association Onl’Fait,
      s’est spécialisé dans l’entrepreneuriat social avec 6 ans d’expérience à la chambre de l’économie sociale et solidaire de Genève.
      Il est aussi entrepreneur et gère la société The Square Sarl.
      Reconnu pour son sens de la communication, il est également à l’origine des pochettes Paw!'
    ],

    [
      'name'        => 'Sébastien Mischler',
      'picture'     => pfm_public_url('images/founders/sebastien.jpg'),
      'description' => 'Sébastien Mischler (trésorier), électricien de formation, et cofondateur de l’association Onl’Fait.
      Il contribue activement depuis plusieurs années à des projets Open-Source tels que RepRap, LaserWeb, SmoothieBoard.
      Il est également le créateur d’un modèle d’imprimante 3D utilisé dans d’autres fablabs (le modèle RepRap iTopie).'
    ]
  ];
}
?>

<section>
  <h1 class="title">La Mission</h1>
  <p>
    Fondée en mars 2016 la mission de l’association Onl’Fait est de créer,
    animer et maintenir des espaces dédiés (fablabs) à l’innovation technologique pour des particuliers,
    et organisations souhaitant apprendre, enseigner et partager de façon collective sur des problématiques techniques,
    sociales et environnementales et ainsi développer la responsabilité citoyenne de chacun.
  </p>
  <h1 class="title">Les Statuts</h1>
  <p><a href="<?php echo pfm_public_url('PDF/status_07_2019.pdf') ?>">TÉLÉCHARGER LES STATUTS AU FORMAT PDF</a></p>
  <h1 class="title">Fondatrices & Fondateurs</h1>
  <div class="grid v-pad-x2">
    <?php foreach (pfm_get_founders() as $founder): ?>
    <div class="cell cell-12 cell-tablet-4 h-pad-x2">
      <img class="responsive" src="<?php echo $founder['picture'] ?>" alt="<?php echo $founder['name'] ?>">
      <div class="cell h-spacer height-x2"></div>
    </div>
    <div class="cell cell-12 cell-tablet-8 h-pad-x2">
      <?php echo $founder['description'] ?>
    </div>
    <div class="cell h-spacer height-x5"></div>
    <?php endforeach; ?>
  </div>
</section>
