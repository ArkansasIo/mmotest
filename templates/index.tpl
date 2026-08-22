
<div class="app-shell">
  <div class="window-bar window-bar-global"><span class="window-lights"><i></i><i></i><i></i></span><strong>UNIVERSE CIVILIZATION // v0.9.0 · BUILD 2026.08.17</strong><span class="window-status">ONLINE</span></div>
  <div class="top-header">
    <div class="top-brand">
      <img src="images/logo.gif" alt="Universe Civilization: Empire At Wars" />
      <div>
        <h1>Universe Civilization: Empire At Wars</h1>
        <p>Strategic war console and empire operations</p>
      </div>
    </div>
    <div class="top-stats">
      <div class="stat-pill"><span>Rank</span><strong id="isRank"></strong></div>
      <div class="stat-pill"><span>Turns</span><strong id="turns"></strong></div>
      <div class="stat-pill"><span>Naquadah</span><strong id="inHand"></strong></div>
      <div class="stat-pill"><span>In Bank</span><strong id="inBank"></strong></div>
      <div class="stat-pill"><span>Metal</span><strong id="metal"></strong></div>
      <div class="stat-pill"><span>Crystal</span><strong id="crystal"></strong></div>
      <div class="stat-pill"><span>Deuterium</span><strong id="deuterium"></strong></div>
      <div class="stat-pill"><span>Food</span><strong id="food"></strong></div>
      <div class="stat-pill"><span>Water</span><strong id="water"></strong></div>
      <div class="stat-pill"><span>Population</span><strong id="population"></strong></div>
      <div class="stat-pill"><span>Energy</span><strong id="energy"></strong></div>
      <div class="stat-pill"><span>Server Time</span><strong id="serverTime"></strong></div>
      <div class="stat-pill"><span>Next Turn</span><strong id="next">&nbsp;</strong></div>
      <div class="stat-pill"><span>Messages</span><strong><a href="javascript:void(0)" onclick="sendData('messages','get','mainDisplay'); return false" id="messages"></a></strong></div>
    </div>
  </div>

  <div class="top-sub-header">
    <div class="top-sub-header-left">
      <form name="form1" action="javascript:void(0);">
        <input id="keyword" name="keyword" autocomplete="on" placeholder="Search pilot by name" />
        <div class="autocompleteContainer">
          <div id="autocomplete" class="autocomplete"></div>
        </div>
        <input type="hidden" name="userID" id="userID" value="" />
        <input type="button" value="Get Info" onclick="sendData('user','get',userID.value); return false;" />
      </form>
    </div>
    <div class="top-sub-header-right">
      <span id="time"></span>
      <a href="?logout=true">Logout</a>
    </div>
  </div>

  <div class="quick-access-header">
    <div class="window-bar window-bar-compact"><span class="window-lights"><i></i><i></i><i></i></span><strong>QUICK ACCESS</strong><span class="window-status">READY</span></div>
    <div class="quick-access-links">
      <a href="javascript:void(0)" onclick="sendData('pages','get','empire','home'); return false"><span class="footer-icon-link"><img src="images/ui/empire.svg" alt="Home" /><span>Home</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('pages','get','universe','galaxies'); return false"><span class="footer-icon-link"><img src="images/ui/universe.svg" alt="Universe" /><span>Universe</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('rtscombat','get','mainDisplay'); return false"><span class="footer-icon-link"><img src="images/ui/military.svg" alt="Combat" /><span>Combat</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('hyperspace','get','mainDisplay'); return false"><span class="footer-icon-link"><img src="images/ui/universe.svg" alt="Hyperspace" /><span>Hyperspace</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('pages','get','research','tree'); return false"><span class="footer-icon-link"><img src="images/ui/research.svg" alt="Research" /><span>Research</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('resourcehq','get','mainDisplay'); return false">Resource HQ</a>
      <a href="javascript:void(0)" onclick="sendData('pages','get','economy','banking'); return false"><span class="footer-icon-link"><img src="images/ui/economy.svg" alt="Bank" /><span>Bank</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('pages','get','diplomacy','messages'); return false"><span class="footer-icon-link"><img src="images/ui/diplomacy.svg" alt="Messages" /><span>Messages</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('pages','get','operations','logs'); return false">Logs</a>
      <a href="javascript:void(0)" onclick="sendData('pages','get','help','newplayer'); return false"><span class="footer-icon-link"><img src="images/ui/help.svg" alt="Help" /><span>Help</span></span></a>
      <a href="javascript:void(0)" onclick="sendData('strategy_codex','get','mainDisplay'); return false">Strategy Codex</a>
      <a href="forums/" target="_blank">Forums</a>
    </div>
  </div>

  <div class="main-layout">
    <aside class="left-menu window-panel" data-navigation-manifest="config/navigation/ogame_sidebar_manifest.php" data-navigation-style="ogame-left-sidebar">
      <div class="window-bar"><span class="window-lights"><i></i><i></i><i></i></span><strong>COMMAND MODULES</strong><span class="window-status">REGISTRY NAV</span></div>
      <h3>Master Navigation</h3>

      <div class="menu-section-title"><img src="images/ui/core-command.svg" alt="Navigation" /><span>01 · OVERVIEW // COMMAND STATUS</span></div>
      <details open>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Overview" /><span>Overview</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="overview" data-nav-page="overview-dashboard" onclick="sendData('pages','get','overview','overview-dashboard'); return false">Dashboard</a>
          <a href="javascript:void(0)" data-nav-group="overview" data-nav-page="empire-overview" onclick="sendData('pages','get','overview','empire-overview'); return false">Empire Overview</a>
          <a href="javascript:void(0)" data-nav-group="overview" data-nav-page="active-operations" onclick="sendData('pages','get','overview','active-operations'); return false">Active Operations</a>
        <details>
          <summary><span class="menu-summary"><span>Overview Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="overview" data-nav-page="alerts" onclick="sendData('pages','get','overview','alerts'); return false">Alerts</a>
            <a href="javascript:void(0)" data-nav-group="overview" data-nav-page="tutorial-objectives" onclick="sendData('pages','get','overview','tutorial-objectives'); return false">Tutorial / Objectives</a>
        </details>
        <details>
          <summary><span class="menu-summary"><span>Commander</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="command-center" data-nav-page="account-info" onclick="sendData('pages','get','command-center','account-info'); return false">Commander Account</a>
            <a href="javascript:void(0)" data-nav-group="command-center" data-nav-page="dashboard" onclick="sendData('pages','get','command-center','dashboard'); return false">Command Structure</a>
            <a href="javascript:void(0)" data-nav-group="account" data-nav-page="race" onclick="sendData('pages','get','account','race'); return false">Race Selection</a>
            <a href="javascript:void(0)" data-nav-group="account" data-nav-page="vacation" onclick="sendData('pages','get','account','vacation'); return false">Vacation Mode</a>
            <a href="javascript:void(0)" data-nav-group="account" data-nav-page="ascension" onclick="sendData('pages','get','account','ascension'); return false">Ascension Progression</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Command Center" /><span>Command Center</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="command-center" data-nav-page="dashboard" onclick="sendData('pages','get','command-center','dashboard'); return false">Dashboard</a>
          <a href="javascript:void(0)" data-nav-group="command-center" data-nav-page="account-info" onclick="sendData('pages','get','command-center','account-info'); return false">Account Info</a>
          <a href="javascript:void(0)" data-nav-group="command-center" data-nav-page="resources" onclick="sendData('pages','get','command-center','resources'); return false">Resources</a>
        <details>
          <summary><span class="menu-summary"><span>Command Center Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="command-center" data-nav-page="income" onclick="sendData('pages','get','command-center','income'); return false">Income</a>
            <a href="javascript:void(0)" data-nav-group="command-center" data-nav-page="military-stats" onclick="sendData('pages','get','command-center','military-stats'); return false">Military Stats</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Account" /><span>Account</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="account" data-nav-page="race" onclick="sendData('pages','get','account','race'); return false">Race</a>
          <a href="javascript:void(0)" data-nav-group="account" data-nav-page="vacation" onclick="sendData('pages','get','account','vacation'); return false">Vacation</a>
        <details>
          <summary><span class="menu-summary"><span>Account Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="account" data-nav-page="ascension" onclick="sendData('pages','get','account','ascension'); return false">Ascension</a>
        </details>
      </details>

      <div class="menu-section-title"><img src="images/ui/core-command.svg" alt="Navigation" /><span>02 · CONFLICT // ATTACK & DEFENSE</span></div>
      <details open>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Attack" /><span>Attack</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="attack" data-nav-page="targets" onclick="sendData('pages','get','attack','targets'); return false">Targets</a>
          <a href="javascript:void(0)" data-nav-group="attack" data-nav-page="spy" onclick="sendData('pages','get','attack','spy'); return false">Spy</a>
        <details>
          <summary><span class="menu-summary"><span>Attack Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="attack" data-nav-page="sabotage" onclick="sendData('pages','get','attack','sabotage'); return false">Sabotage</a>
            <a href="javascript:void(0)" data-nav-group="attack" data-nav-page="attack-log" onclick="sendData('pages','get','attack','attack-log'); return false">Attack Log</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Armory" /><span>Armory</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="armory" data-nav-page="weapons" onclick="sendData('pages','get','armory','weapons'); return false">Weapons</a>
          <a href="javascript:void(0)" data-nav-group="armory" data-nav-page="weapon-market" onclick="sendData('pages','get','armory','weapon-market'); return false">Weapon Market</a>
        <details>
          <summary><span class="menu-summary"><span>Armory Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="armory" data-nav-page="repair" onclick="sendData('pages','get','armory','repair'); return false">Repair</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Training" /><span>Training</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="training" data-nav-page="units" onclick="sendData('pages','get','training','units'); return false">Units</a>
          <a href="javascript:void(0)" data-nav-group="training" data-nav-page="miners" onclick="sendData('pages','get','training','miners'); return false">Miners</a>
        <details>
          <summary><span class="menu-summary"><span>Training Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="training" data-nav-page="super-units" onclick="sendData('pages','get','training','super-units'); return false">Super Units</a>
            <a href="javascript:void(0)" data-nav-group="training" data-nav-page="unit-production" onclick="sendData('pages','get','training','unit-production'); return false">Unit Production</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Technology" /><span>Technology</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="technology" data-nav-page="technology" onclick="sendData('pages','get','technology','technology'); return false">Technology</a>
          <a href="javascript:void(0)" data-nav-group="technology" data-nav-page="tech-offense" onclick="sendData('pages','get','technology','tech-offense'); return false">Tech Offense</a>
          <a href="javascript:void(0)" data-nav-group="technology" data-nav-page="tech-defense" onclick="sendData('pages','get','technology','tech-defense'); return false">Tech Defense</a>
        <details>
          <summary><span class="menu-summary"><span>Technology Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="technology" data-nav-page="tech-covert" onclick="sendData('pages','get','technology','tech-covert'); return false">Tech Covert</a>
            <a href="javascript:void(0)" data-nav-group="technology" data-nav-page="tech-anti-covert" onclick="sendData('pages','get','technology','tech-anti-covert'); return false">Tech Anti Covert</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Intelligence" /><span>Intelligence</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="spy-log" onclick="sendData('pages','get','intelligence','spy-log'); return false">Spy Log</a>
          <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="enemy-intelligence" onclick="sendData('pages','get','intelligence','enemy-intelligence'); return false">Enemy Intelligence</a>
          <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="intelligence-espionage" onclick="sendData('pages','get','intelligence','intelligence-espionage'); return false">Intelligence Espionage</a>
          <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="spy-missions" onclick="sendData('pages','get','intelligence','spy-missions'); return false">Spy Missions</a>
          <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="counter-espionage" onclick="sendData('pages','get','intelligence','counter-espionage'); return false">Counter Espionage</a>
        <details>
          <summary><span class="menu-summary"><span>Intelligence Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="intelligence-sabotage" onclick="sendData('pages','get','intelligence','intelligence-sabotage'); return false">Intelligence Sabotage</a>
            <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="reconnaissance" onclick="sendData('pages','get','intelligence','reconnaissance'); return false">Reconnaissance</a>
            <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="sensor-phalanx" onclick="sendData('pages','get','intelligence','sensor-phalanx'); return false">Sensor Phalanx</a>
            <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="fleet-activity" onclick="sendData('pages','get','intelligence','fleet-activity'); return false">Fleet Activity</a>
            <a href="javascript:void(0)" data-nav-group="intelligence" data-nav-page="intelligence-reports" onclick="sendData('pages','get','intelligence','intelligence-reports'); return false">Intelligence Reports</a>
        </details>
      </details>

      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Fleet" /><span>Fleet</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="fleet-manager" onclick="sendData('pages','get','fleet','fleet-manager'); return false">Fleet Manager</a>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="starships" onclick="sendData('pages','get','fleet','starships'); return false">Starships</a>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="motherships" onclick="sendData('pages','get','fleet','motherships'); return false">Motherships</a>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="ship-upgrades" onclick="sendData('pages','get','fleet','ship-upgrades'); return false">Ship Upgrades</a>
        <details><summary><span class="menu-summary"><span>Fleet Subsystems</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="formations" onclick="sendData('pages','get','fleet','formations'); return false">Formations</a>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="fleet-missions" onclick="sendData('pages','get','fleet','fleet-missions'); return false">Fleet Missions</a>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="expeditions" onclick="sendData('pages','get','fleet','expeditions'); return false">Expeditions</a>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="fleet-save" onclick="sendData('pages','get','fleet','fleet-save'); return false">Fleet Save</a>
          <a href="javascript:void(0)" data-nav-group="fleet" data-nav-page="acs" onclick="sendData('pages','get','fleet','acs'); return false">Alliance Combat</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Military" /><span>Military</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="ground-forces" onclick="sendData('pages','get','military','ground-forces'); return false">Ground Forces</a>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="military-units" onclick="sendData('pages','get','military','military-units'); return false">Military Units</a>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="officers" onclick="sendData('pages','get','military','officers'); return false">Officers</a>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="training-center" onclick="sendData('pages','get','military','training-center'); return false">Training Center</a>
        <details><summary><span class="menu-summary"><span>Military Subsystems</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="planetary-defense" onclick="sendData('pages','get','military','planetary-defense'); return false">Planetary Defense</a>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="missile-warfare" onclick="sendData('pages','get','military','missile-warfare'); return false">Missile Warfare</a>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="combat-simulator" onclick="sendData('pages','get','military','combat-simulator'); return false">Combat Simulator</a>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="war-room" onclick="sendData('pages','get','military','war-room'); return false">War Room</a>
          <a href="javascript:void(0)" data-nav-group="military" data-nav-page="campaigns" onclick="sendData('pages','get','military','campaigns'); return false">Campaigns</a>
        </details>
      </details>

      <div class="menu-section-title"><img src="images/ui/core-command.svg" alt="Navigation" /><span>03 · DEVELOPMENT // EMPIRE & CONSTRUCTION</span></div>
      <details open>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Empire" /><span>Empire</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="planets" onclick="sendData('pages','get','empire','planets'); return false">Planets</a>
          <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="colonies" onclick="sendData('pages','get','empire','colonies'); return false">Colonies</a>
          <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="empire-moons" onclick="sendData('pages','get','empire','empire-moons'); return false">Empire Moons</a>
          <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="buildings" onclick="sendData('pages','get','empire','buildings'); return false">Buildings</a>
        <details>
          <summary><span class="menu-summary"><span>Empire Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="facilities" onclick="sendData('pages','get','empire','facilities'); return false">Facilities</a>
            <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="storage" onclick="sendData('pages','get','empire','storage'); return false">Storage</a>
            <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="population" onclick="sendData('pages','get','empire','population'); return false">Population</a>
            <a href="javascript:void(0)" data-nav-group="empire" data-nav-page="planet-specialization" onclick="sendData('pages','get','empire','planet-specialization'); return false">Planet Specialization</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Resources" /><span>Resources</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="resource-overview" onclick="sendData('pages','get','resources','resource-overview'); return false">Resource Overview</a>
          <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="metal" onclick="sendData('pages','get','resources','metal'); return false">Metal</a>
          <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="crystal" onclick="sendData('pages','get','resources','crystal'); return false">Crystal</a>
          <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="deuterium" onclick="sendData('pages','get','resources','deuterium'); return false">Deuterium</a>
          <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="naquadah" onclick="sendData('pages','get','resources','naquadah'); return false">Naquadah</a>
        <details>
          <summary><span class="menu-summary"><span>Resources Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="energy" onclick="sendData('pages','get','resources','energy'); return false">Energy</a>
            <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="dark-matter" onclick="sendData('pages','get','resources','dark-matter'); return false">Dark Matter</a>
            <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="production" onclick="sendData('pages','get','resources','production'); return false">Production</a>
            <a href="javascript:void(0)" data-nav-group="resources" data-nav-page="energy-grid" onclick="sendData('pages','get','resources','energy-grid'); return false">Energy Grid</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Construction" /><span>Construction</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="construction-buildings" onclick="sendData('pages','get','construction','construction-buildings'); return false">Construction Buildings</a>
          <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="construction-facilities" onclick="sendData('pages','get','construction','construction-facilities'); return false">Construction Facilities</a>
          <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="construction-queue" onclick="sendData('pages','get','construction','construction-queue'); return false">Construction Queue</a>
          <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="shipyard" onclick="sendData('pages','get','construction','shipyard'); return false">Shipyard</a>
          <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="defense" onclick="sendData('pages','get','construction','defense'); return false">Defense</a>
        <details>
          <summary><span class="menu-summary"><span>Construction Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="robotics" onclick="sendData('pages','get','construction','robotics'); return false">Robotics</a>
            <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="nanite-factory" onclick="sendData('pages','get','construction','nanite-factory'); return false">Nanite Factory</a>
            <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="terraformer" onclick="sendData('pages','get','construction','terraformer'); return false">Terraformer</a>
            <a href="javascript:void(0)" data-nav-group="construction" data-nav-page="space-dock" onclick="sendData('pages','get','construction','space-dock'); return false">Space Dock</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Research" /><span>Research</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="research" data-nav-page="research-technology" onclick="sendData('pages','get','research','research-technology'); return false">Research Technology</a>
          <a href="javascript:void(0)" data-nav-group="research" data-nav-page="advanced-research" onclick="sendData('pages','get','research','advanced-research'); return false">Advanced Research</a>
          <a href="javascript:void(0)" data-nav-group="research" data-nav-page="combat" onclick="sendData('pages','get','research','combat'); return false">Combat</a>
          <a href="javascript:void(0)" data-nav-group="research" data-nav-page="propulsion" onclick="sendData('pages','get','research','propulsion'); return false">Propulsion</a>
          <a href="javascript:void(0)" data-nav-group="research" data-nav-page="espionage" onclick="sendData('pages','get','research','espionage'); return false">Espionage</a>
        <details>
          <summary><span class="menu-summary"><span>Research Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="research" data-nav-page="astrophysics" onclick="sendData('pages','get','research','astrophysics'); return false">Astrophysics</a>
            <a href="javascript:void(0)" data-nav-group="research" data-nav-page="stargate-technology" onclick="sendData('pages','get','research','stargate-technology'); return false">Stargate Technology</a>
            <a href="javascript:void(0)" data-nav-group="research" data-nav-page="mothership-technology" onclick="sendData('pages','get','research','mothership-technology'); return false">Mothership Technology</a>
            <a href="javascript:void(0)" data-nav-group="research" data-nav-page="lifeform-research" onclick="sendData('pages','get','research','lifeform-research'); return false">Lifeform Research</a>
            <a href="javascript:void(0)" data-nav-group="research" data-nav-page="ascension-research" onclick="sendData('pages','get','research','ascension-research'); return false">Ascension Research</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Planets" /><span>Planets</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="planets" data-nav-page="planet-list" onclick="sendData('pages','get','planets','planet-list'); return false">Planet List</a>
          <a href="javascript:void(0)" data-nav-group="planets" data-nav-page="settlement" onclick="sendData('pages','get','planets','settlement'); return false">Settlement</a>
        <details>
          <summary><span class="menu-summary"><span>Planets Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="planets" data-nav-page="planet-bonuses" onclick="sendData('pages','get','planets','planet-bonuses'); return false">Planet Bonuses</a>
            <a href="javascript:void(0)" data-nav-group="planets" data-nav-page="planet-defenses" onclick="sendData('pages','get','planets','planet-defenses'); return false">Planet Defenses</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Mothership" /><span>Mothership</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="mothership" data-nav-page="ship" onclick="sendData('pages','get','mothership','ship'); return false">Ship</a>
          <a href="javascript:void(0)" data-nav-group="mothership" data-nav-page="modules" onclick="sendData('pages','get','mothership','modules'); return false">Modules</a>
        <details>
          <summary><span class="menu-summary"><span>Mothership Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="mothership" data-nav-page="exploration" onclick="sendData('pages','get','mothership','exploration'); return false">Exploration</a>
        </details>
      </details>

      <div class="menu-section-title"><img src="images/ui/core-command.svg" alt="Navigation" /><span>04 · EXPLORATION // GALAXY & UNIVERSE</span></div>
      <details open>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Galaxy" /><span>Galaxy</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="galaxy-view" onclick="sendData('pages','get','galaxy','galaxy-view'); return false">Galaxy View</a>
          <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="galaxy-map" onclick="sendData('pages','get','galaxy','galaxy-map'); return false">Galaxy Map</a>
          <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="galaxy-solar-systems" onclick="sendData('pages','get','galaxy','galaxy-solar-systems'); return false">Galaxy Solar Systems</a>
          <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="3d-universe" onclick="sendData('pages','get','galaxy','3d-universe'); return false">3D Universe</a>
          <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="galaxy-sectors" onclick="sendData('pages','get','galaxy','galaxy-sectors'); return false">Galaxy Sectors</a>
          <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="realm-systems" onclick="sendData('pages','get','galaxy','realm-systems'); return false">Realm Systems</a>
        <details>
          <summary><span class="menu-summary"><span>Galaxy Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="stargate-network" onclick="sendData('pages','get','galaxy','stargate-network'); return false">Stargate Network</a>
            <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="wormholes" onclick="sendData('pages','get','galaxy','wormholes'); return false">Wormholes</a>
            <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="anomalies" onclick="sendData('pages','get','galaxy','anomalies'); return false">Anomalies</a>
            <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="npc-factions" onclick="sendData('pages','get','galaxy','npc-factions'); return false">Npc Factions</a>
            <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="seed-discovery" onclick="sendData('pages','get','galaxy','seed-discovery'); return false">Seed Discovery</a>
            <a href="javascript:void(0)" data-nav-group="galaxy" data-nav-page="galactic-calendar" onclick="sendData('pages','get','galaxy','galactic-calendar'); return false">Galactic Calendar</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Universe" /><span>Universe</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="universe" data-nav-page="galaxies" onclick="sendData('pages','get','universe','galaxies'); return false">Galaxies</a>
          <a href="javascript:void(0)" data-nav-group="universe" data-nav-page="sectors" onclick="sendData('pages','get','universe','sectors'); return false">Sectors</a>
          <a href="javascript:void(0)" data-nav-group="universe" data-nav-page="solar-systems" onclick="sendData('pages','get','universe','solar-systems'); return false">Solar Systems</a>
        <details>
          <summary><span class="menu-summary"><span>Universe Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="universe" data-nav-page="universe-planets" onclick="sendData('pages','get','universe','universe-planets'); return false">Universe Planets</a>
            <a href="javascript:void(0)" data-nav-group="universe" data-nav-page="moons" onclick="sendData('pages','get','universe','moons'); return false">Moons</a>
            <a href="javascript:void(0)" data-nav-group="universe" data-nav-page="coordinates" onclick="sendData('pages','get','universe','coordinates'); return false">Coordinates</a>
        </details>
      </details>

      <div class="menu-section-title"><img src="images/ui/core-command.svg" alt="Navigation" /><span>05 · ECONOMY // SOCIAL & ALLIANCE</span></div>
      <details open>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Economy" /><span>Economy</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="economy" data-nav-page="marketplace" onclick="sendData('pages','get','economy','marketplace'); return false">Marketplace</a>
          <a href="javascript:void(0)" data-nav-group="economy" data-nav-page="resource-trading" onclick="sendData('pages','get','economy','resource-trading'); return false">Resource Trading</a>
          <a href="javascript:void(0)" data-nav-group="economy" data-nav-page="trade-routes" onclick="sendData('pages','get','economy','trade-routes'); return false">Trade Routes</a>
          <a href="javascript:void(0)" data-nav-group="economy" data-nav-page="merchant" onclick="sendData('pages','get','economy','merchant'); return false">Merchant</a>
        <details>
          <summary><span class="menu-summary"><span>Economy Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="economy" data-nav-page="auction-house" onclick="sendData('pages','get','economy','auction-house'); return false">Auction House</a>
            <a href="javascript:void(0)" data-nav-group="economy" data-nav-page="black-market" onclick="sendData('pages','get','economy','black-market'); return false">Black Market</a>
            <a href="javascript:void(0)" data-nav-group="economy" data-nav-page="insurance" onclick="sendData('pages','get','economy','insurance'); return false">Insurance</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Market" /><span>Market</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="market" data-nav-page="resource-exchange" onclick="sendData('pages','get','market','resource-exchange'); return false">Resource Exchange</a>
        <details>
          <summary><span class="menu-summary"><span>Market Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="market" data-nav-page="mercenary-market" onclick="sendData('pages','get','market','mercenary-market'); return false">Mercenary Market</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Social" /><span>Social</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="social" data-nav-page="rankings" onclick="sendData('pages','get','social','rankings'); return false">Rankings</a>
          <a href="javascript:void(0)" data-nav-group="social" data-nav-page="alliances" onclick="sendData('pages','get','social','alliances'); return false">Alliances</a>
          <a href="javascript:void(0)" data-nav-group="social" data-nav-page="messages" onclick="sendData('pages','get','social','messages'); return false">Messages</a>
          <a href="javascript:void(0)" data-nav-group="social" data-nav-page="social-messages" onclick="sendData('pages','get','social','social-messages'); return false">Social Messages</a>
          <a href="javascript:void(0)" data-nav-group="social" data-nav-page="notifications" onclick="sendData('pages','get','social','notifications'); return false">Notifications</a>
        <details>
          <summary><span class="menu-summary"><span>Social Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="social" data-nav-page="global-chat" onclick="sendData('pages','get','social','global-chat'); return false">Global Chat</a>
            <a href="javascript:void(0)" data-nav-group="social" data-nav-page="buddy-list" onclick="sendData('pages','get','social','buddy-list'); return false">Buddy List</a>
            <a href="javascript:void(0)" data-nav-group="social" data-nav-page="recruitment" onclick="sendData('pages','get','social','recruitment'); return false">Recruitment</a>
            <a href="javascript:void(0)" data-nav-group="social" data-nav-page="empires-at-war" onclick="sendData('pages','get','social','empires-at-war'); return false">Empires At War</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Alliance" /><span>Alliance</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="alliance-hub" onclick="sendData('pages','get','alliance','alliance-hub'); return false">Alliance Hub</a>
          <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="members" onclick="sendData('pages','get','alliance','members'); return false">Members</a>
          <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="commanders" onclick="sendData('pages','get','alliance','commanders'); return false">Commanders</a>
          <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="alliance-officers" onclick="sendData('pages','get','alliance','alliance-officers'); return false">Alliance Officers</a>
          <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="diplomacy" onclick="sendData('pages','get','alliance','diplomacy'); return false">Diplomacy</a>
        <details>
          <summary><span class="menu-summary"><span>Alliance Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="war" onclick="sendData('pages','get','alliance','war'); return false">War</a>
            <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="alliance-acs" onclick="sendData('pages','get','alliance','alliance-acs'); return false">Alliance Acs</a>
            <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="alliance-logistics" onclick="sendData('pages','get','alliance','alliance-logistics'); return false">Alliance Logistics</a>
            <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="alliance-stargates" onclick="sendData('pages','get','alliance','alliance-stargates'); return false">Alliance Stargates</a>
            <a href="javascript:void(0)" data-nav-group="alliance" data-nav-page="alliance-intelligence" onclick="sendData('pages','get','alliance','alliance-intelligence'); return false">Alliance Intelligence</a>
        </details>
      </details>

      <div class="menu-section-title"><img src="images/ui/core-command.svg" alt="Navigation" /><span>06 · PROGRESSION // CRAFTING & PRESTIGE</span></div>
      <details open>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Crafting" /><span>Crafting</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="workshop" onclick="sendData('pages','get','crafting','workshop'); return false">Workshop</a>
          <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="master-crafting" onclick="sendData('pages','get','crafting','master-crafting'); return false">Master Crafting</a>
          <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="crafting-rank" onclick="sendData('pages','get','crafting','crafting-rank'); return false">Crafting Rank</a>
          <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="materials" onclick="sendData('pages','get','crafting','materials'); return false">Materials</a>
          <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="materials-lab" onclick="sendData('pages','get','crafting','materials-lab'); return false">Materials Lab</a>
        <details>
          <summary><span class="menu-summary"><span>Crafting Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="dismantling" onclick="sendData('pages','get','crafting','dismantling'); return false">Dismantling</a>
            <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="augmentations" onclick="sendData('pages','get','crafting','augmentations'); return false">Augmentations</a>
            <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="artifacts" onclick="sendData('pages','get','crafting','artifacts'); return false">Artifacts</a>
            <a href="javascript:void(0)" data-nav-group="crafting" data-nav-page="blueprints" onclick="sendData('pages','get','crafting','blueprints'); return false">Blueprints</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Lifeforms" /><span>Lifeforms</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="lifeforms" data-nav-page="lifeforms-population" onclick="sendData('pages','get','lifeforms','lifeforms-population'); return false">Lifeforms Population</a>
          <a href="javascript:void(0)" data-nav-group="lifeforms" data-nav-page="food" onclick="sendData('pages','get','lifeforms','food'); return false">Food</a>
          <a href="javascript:void(0)" data-nav-group="lifeforms" data-nav-page="lifeform-buildings" onclick="sendData('pages','get','lifeforms','lifeform-buildings'); return false">Lifeform Buildings</a>
          <a href="javascript:void(0)" data-nav-group="lifeforms" data-nav-page="lifeforms-lifeform-research" onclick="sendData('pages','get','lifeforms','lifeforms-lifeform-research'); return false">Lifeforms Lifeform Research</a>
        <details>
          <summary><span class="menu-summary"><span>Lifeforms Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="lifeforms" data-nav-page="civilization-tier" onclick="sendData('pages','get','lifeforms','civilization-tier'); return false">Civilization Tier</a>
            <a href="javascript:void(0)" data-nav-group="lifeforms" data-nav-page="traits" onclick="sendData('pages','get','lifeforms','traits'); return false">Traits</a>
            <a href="javascript:void(0)" data-nav-group="lifeforms" data-nav-page="lifeform-bonuses" onclick="sendData('pages','get','lifeforms','lifeform-bonuses'); return false">Lifeform Bonuses</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Activities" /><span>Activities</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="quests" onclick="sendData('pages','get','activities','quests'); return false">Quests</a>
          <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="activities-expeditions" onclick="sendData('pages','get','activities','activities-expeditions'); return false">Activities Expeditions</a>
          <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="pirate-hunting" onclick="sendData('pages','get','activities','pirate-hunting'); return false">Pirate Hunting</a>
          <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="bounty-board" onclick="sendData('pages','get','activities','bounty-board'); return false">Bounty Board</a>
          <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="world-bosses" onclick="sendData('pages','get','activities','world-bosses'); return false">World Bosses</a>
        <details>
          <summary><span class="menu-summary"><span>Activities Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="activities-anomalies" onclick="sendData('pages','get','activities','activities-anomalies'); return false">Activities Anomalies</a>
            <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="activities-campaigns" onclick="sendData('pages','get','activities','activities-campaigns'); return false">Activities Campaigns</a>
            <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="achievements" onclick="sendData('pages','get','activities','achievements'); return false">Achievements</a>
            <a href="javascript:void(0)" data-nav-group="activities" data-nav-page="seasonal-events" onclick="sendData('pages','get','activities','seasonal-events'); return false">Seasonal Events</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Prestige" /><span>Prestige</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="prestige" data-nav-page="glory" onclick="sendData('pages','get','prestige','glory'); return false">Glory</a>
          <a href="javascript:void(0)" data-nav-group="prestige" data-nav-page="reputation" onclick="sendData('pages','get','prestige','reputation'); return false">Reputation</a>
          <a href="javascript:void(0)" data-nav-group="prestige" data-nav-page="prestige-ascension" onclick="sendData('pages','get','prestige','prestige-ascension'); return false">Prestige Ascension</a>
          <a href="javascript:void(0)" data-nav-group="prestige" data-nav-page="re-ascension" onclick="sendData('pages','get','prestige','re-ascension'); return false">Re Ascension</a>
        <details>
          <summary><span class="menu-summary"><span>Prestige Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="prestige" data-nav-page="ascended-races" onclick="sendData('pages','get','prestige','ascended-races'); return false">Ascended Races</a>
            <a href="javascript:void(0)" data-nav-group="prestige" data-nav-page="titles" onclick="sendData('pages','get','prestige','titles'); return false">Titles</a>
            <a href="javascript:void(0)" data-nav-group="prestige" data-nav-page="permanent-bonuses" onclick="sendData('pages','get','prestige','permanent-bonuses'); return false">Permanent Bonuses</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Rankings" /><span>Rankings</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="empire" onclick="sendData('pages','get','rankings','empire'); return false">Empire</a>
          <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="economy" onclick="sendData('pages','get','rankings','economy'); return false">Economy</a>
          <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="fleet" onclick="sendData('pages','get','rankings','fleet'); return false">Fleet</a>
          <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="research" onclick="sendData('pages','get','rankings','research'); return false">Research</a>
          <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="rankings-defense" onclick="sendData('pages','get','rankings','rankings-defense'); return false">Rankings Defense</a>
        <details>
          <summary><span class="menu-summary"><span>Rankings Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="covert" onclick="sendData('pages','get','rankings','covert'); return false">Covert</a>
            <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="alliance" onclick="sendData('pages','get','rankings','alliance'); return false">Alliance</a>
            <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="lifeform" onclick="sendData('pages','get','rankings','lifeform'); return false">Lifeform</a>
            <a href="javascript:void(0)" data-nav-group="rankings" data-nav-page="galactic-control" onclick="sendData('pages','get','rankings','galactic-control'); return false">Galactic Control</a>
        </details>
      </details>
      <details>
        <summary><span class="menu-summary"><img src="images/ui/core-command.svg" alt="Premium" /><span>Premium</span></span></summary>
          <a href="javascript:void(0)" data-nav-group="premium" data-nav-page="store" onclick="sendData('pages','get','premium','store'); return false">Store</a>
          <a href="javascript:void(0)" data-nav-group="premium" data-nav-page="premium-officers" onclick="sendData('pages','get','premium','premium-officers'); return false">Premium Officers</a>
        <details>
          <summary><span class="menu-summary"><span>Premium Subsystems</span></span></summary>
            <a href="javascript:void(0)" data-nav-group="premium" data-nav-page="commander" onclick="sendData('pages','get','premium','commander'); return false">Commander</a>
            <a href="javascript:void(0)" data-nav-group="premium" data-nav-page="premium-services" onclick="sendData('pages','get','premium','premium-services'); return false">Premium Services</a>
        </details>
      </details>

      <div class="menu-section-title"><img src="images/ui/help.svg" alt="Support" /><span>07 · SUPPORT // DIRECT TOOLS</span></div>
      <details open>
        <summary><span class="menu-summary"><img src="images/ui/help.svg" alt="Help" /><span>Help &amp; Direct Tools</span></span></summary>
          <a href="javascript:void(0)" onclick="sendData('account','get','mainDisplay'); return false">Account Settings</a>
          <a href="javascript:void(0)" onclick="sendData('strategy_codex','get','mainDisplay'); return false">Strategy Codex</a>
          <a href="forums/" target="_blank">Forums</a>
        </details>
    </aside>

    <section class="content-panel window-panel">
      <div class="window-bar"><span class="window-lights"><i></i><i></i><i></i></span><strong>TACTICAL DISPLAY</strong><span class="window-status">LIVE</span></div>
      <div class="content-header">
        <h2>Command Feed</h2>
        <p>Select a page or submenu on the left to load a section and sub page.</p>
      </div>
      <div class="window-surface"><div id="mainDisplay"></div></div>
    </section>
  </div>


  <footer class="site-footer">
    <div>
      <strong>Universe Civilization: Empire At Wars</strong> tactical operations network
    </div>
    <div>
      &quot;The clearest strategies turn uncertainty into victory.&quot;
    </div>
  </footer>
</div>

