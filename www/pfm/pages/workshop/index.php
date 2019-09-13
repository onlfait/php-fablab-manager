<?php
// TODO puts this in the database
function pfm_get_machines() {
  return [
    [
      'name'        => 'Découpeuse Laser CO2',
      'picture'     => pfm_public_url('images/machines/laser_cutter.jpg'),
      'description' => 'Elle permet de découper/graver le bois, le plexiglass, le cuire.',
      'details'     => [
        'tool'      => 'RECI 90W',
        'workspace' => '1000 x 600 mm',
        'model'     => 'SignsTech / 1060SP',
        'hardware'  => 'SmoothieBoard',
        'software'  => 'LightBurn, Fabrica'
      ]
    ],

    [
      'name'        => 'Imprimante 3D',
      'picture'     => pfm_public_url('images/machines/3d_printer.jpg'),
      'description' => 'Deux imprimantes 3D sont à disposition.',
      'details'     => [
        'workspace' => '180 x 170 x 170 mm',
        'model'     => 'RepRap / iTopie',
        'hardware'  => 'SmoothieBoard',
        'software'  => 'Cura, Pronterface'
      ]
    ],

    [
      'name'        => 'Fraiseuse numérique (CNC)',
      'picture'     => pfm_public_url('images/machines/cnc.jpg'),
      'description' => 'Elle permet d\'usiner du bois.',
      'details'     => [
        'tool'      => 'KRESS 1050W',
        'workspace' => '800 x 700 x 150 mm',
        'model'     => 'OpenBuilds OX',
        'hardware'  => 'SmoothieBoard',
        'software'  => 'CamBam, MeshCAM, Pronterface'
      ]
    ],

    [
      'name'        => 'Découpeuse Vinyle',
      'picture'     => pfm_public_url('images/machines/vinyl_cutter.jpg'),
      'description' => 'Pour la création de stickers, t-shirts, sacs, etc...',
      'details'     => [
        'workspace' => 'A3',
        'model'     => 'Silhouette CAMEO 3',
        'software'  => 'Silhouette Studio®'
      ]
    ],

    [
      'name'        => 'Thermoformeuse',
      'picture'     => pfm_public_url('images/machines/vacuum_former.jpg'),
      'description' => 'Pour la création de vos moules, coques, etc...',
      'details'     => [
        'workspace' => '220 x 180 mm',
        'model'     => 'DIY'
      ]
    ]
  ];
}

// TODO implements internatonalization
function pfm_get_machines_label($label) {
  static $labels = [
    'tool'      => 'Outil',
    'workspace' => 'Espace de travail',
    'model'     => 'Modèle',
    'hardware'  => 'Electronique',
    'software'  => 'Logiciels'
  ];
  return isset($labels[$label]) ? $labels[$label] : $label;
}
?>

<section>
  <h1 class="title">Espace de Travail</h1>
  <h2 class="subtitle">Les machines</h2>
  <div class="grid v-pad-x2">
  <?php foreach (pfm_get_machines() as $machine): ?>
    <div class="cell cell-12 cell-tablet-4 h-pad-x2">
      <img class="responsive" src="<?php echo $machine['picture'] ?>" alt="<?php echo $machine['name'] ?>">
      <div class="cell h-spacer height-x2"></div>
    </div>
    <div class="cell cell-12 cell-tablet-8 h-pad-x2">
      <div class="text-bold"><?php echo $machine['name'] ?></div>
      <?php echo $machine['description'] ?>
      <div class="h-spacer height-x2"></div>
      <div class="grid">
      <?php foreach ($machine['details'] as $label => $value): ?>
        <div class="cell cell-12 text-bold"><?php echo pfm_get_machines_label($label) ?></div>
        <div class="cell cell-12"><?php echo $value ?></div>
      <?php endforeach; ?>
      </div>
    </div>
    <div class="cell h-spacer height-x5"></div>
  <?php endforeach; ?>
  </div>
</section>
