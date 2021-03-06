import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

let en = {
    conclusion_criterion : 'Conclusion of the criterion',
    hello: 'Hello',
    loading: 'Loading...',
    downloading: 'Downloading...',
    create: 'Create',
    update: 'Update',
    close: 'Close',
    custom_reports:{
      tittle: 'Customized report',
      select_state: 'Select state',
      tittle_general_chart: 'Overall progress',
      general_reports: 'Uploaded reports',
      ejecutive: 'Executive Report',
      detailed: 'Detailed Report',
      documental: 'Documentary sources',
      all_documental: 'All organizational information',
      organization_chart: 'Organization chart',
      map: 'Map',
      cuantitative_source: 'Quantitative sources',
      all_cuantitative_source: 'All statistical variables (by year)',
      cualitative_source: 'Qualitative sources',
      all_cualitative_source: 'All areas of analysis',
      regulatory: 'Regulatory level',
      institutional: 'Institutional level',
      individual: 'Individual level',
      progress: 'progress',
      reportEs: 'Spanish',
      reportEn: 'English',
      button_report: 'Generate costumized report'
    },
    profile:{
      users: 'Users',
      profile: 'Profile',
      activity: 'Activity',
      settings: 'Settings',
      user_activity: 'User activity',
      name: 'Name',
      description:'Description',
      picture: 'Profile picture',
      password: 'Password (skip if no change was made)',
      update: 'Update'

    },
    documental_repository: {
      title: 'Useful information',
      table_disaster: 'Disaster Recovery Plan',
      name: 'Name',
      type: 'Type',
      date: 'Issue date',
      dowload: 'Download',
      delete: 'Delete',
      add: 'Add document',
      forms: 'Formats',
      document: 'Document',
      add_button: 'Add',
      cancel: 'Cancel'
    },
    observationsBySource: {
      tittle_min:'Observations by source by criteria',
      tittle_may: 'OBSERVATIONS BYS SOURCE BY CRITERIA',
      criteria: 'Criteria',
      headquarters: 'Headquarters',
      source:'Source',
      observations: 'Observations',
      conclusion_save: 'Save conclusion',
      change_conclusion: 'Update conclusion',
      conlusion_by_criteria: 'Conclusions by criteria',

      observation_save: 'Save observation',
      update_observation:'Update observation'
    },
    detailedReport:{
      title:'Detailed Report',
      generate_pdf:'Generate PDF',
      generate_docx: 'Generate Docx',
      socio_demographic_data: 'Socio-demographic data',
      state_information: 'State information',
      nacional_average: 'National average',
      ranking: 'Ranking',
      crime_data: 'Crime data',
      state_map: 'State map',
      map_includes: 'Map of the state which includes:',
      AGO_Headquarters: 'AGO Headquarters and offices',
      municipalities_ago: 'Municipalities within AGO regions',
      number_per_region: 'Number of prosecutors per region',
      AGO_Headquarters_offices: 'AGO Headquarters and/or offices',
      municipalities_by_headquartes: 'Municipalities by seat',
      organizational_structure: 'Organizational structure',
      organizational_chart: 'Organizational chart',
      organizational_chart_institution: 'Organization chart of the institution structured at alevel of detail that allows understanding the composition of investigation units.',

      level: 'Level',
      conclusion_by_level: 'Conclusion by level',
      possible_problem: 'Possible problem',
      regulatory: 'Regulatory',
      institutional: 'Institutional',
      individual: 'Individual',

    },
    executiveReport:{
      title: 'Executive Report',
      regulatory_level: 'Regulatory level ',
      institutional_level: 'Institutional level',
      individual_level: 'Individual level',
      criteria: 'Criteria',
      possible_problem:'Possible problem',
      generate_pdf:'Generate PDF',
      generate_docx: 'Generate Docx'
    },
    repository:{
      title: 'Document repository',
      zip: 'Download Zip',
      add_document: 'Add documento',
      documents_from: 'Documents from',
      name: 'Name',
      type:'Type',
      date: 'Issue date',
      dowload: 'Download',
      delete: 'Delete',
      document: 'Document',
      add: 'Add',
      cancel: 'Cancel'


    },
    breadcrumb: {
        home: 'Home',
        state: 'States',
        round: 'Round',
        documentary_information: 'Documentary information',
        users: 'Users',
        sociodemographic: 'Sociodemographic Context',
        quantitative_sources: 'Quantitative Sources',
        qualitative_sources: 'Qualitative Sources',
    },
    states: {
        select_state: 'Please select the state',
        custom_report_button: 'Customized reports and progress dashboard'
    },
    state: {
        title: 'Load information',
        complete_task: 'Complete task',
        in_process_task: 'Task in process',
        pending_task: 'Pending task',
        documentary_information: 'Documentary source',
        quantitative_sources: 'Quantitative sources',
        qualitative_sources: 'Qualitative sources',
        indicator_year : 'indicators per year',

        final_reports_title: 'Final version reports',
        final_reports_spanish: 'Reports in Spanish',
        final_reports_english: 'Reports in English',
        executive_report: 'Executive Report',
        detailed_report: 'Detailed Report',
        dowload_report: 'Download report',
        change_report: 'Change report',
        add_executive_report: 'Add Executive Report',
        add_detailed_report: 'Add Detailed Report',
        document_uploaded: 'The document has not been uploaded yet',
        read_detailed: 'Read Detailed Report',
        read_executive: 'Read Executive Report',
        other_documents: 'OTHER USEFUL STATE DOCUMENTS',
        document_repository: 'Document repository',
        spreadsheet:'Spreadsheet',
        load_data: 'Load data',
        cacel: 'Cancel',
        name: 'Name',
        document_type:'Document type',
        document: 'Document',
        add: 'Add',
    },
    documentary_information: {
        title: 'Documentary information',
        organization_chart: 'Organization chart',
        map: 'Map',
        headquarter: 'Headquarter',

        map_include: 'Map must include:',
        headquarter_offices: 'Headquarters and Regional Offices',
        headquarter_offices_regions: 'Municipalities within AGO regions',
        number_prosecutors: 'Number of prosecutors per region',
        ago_region: 'AGO region',
        options : 'Evaluated headquarters',
        total_headquarter: 'Total headquarters',
        municipalities_seat: 'Municipalities by seat',


    },
    quantitative_sources: {
        title: 'Quantitative data: data for indicators',
        card_header: 'Data capture for indicators',
        complete_task: 'Complete task',
        pending_task: 'Pending task',

        see_indicators_by_decision:'See indicators by decision',
        data_for_previus_year: 'Data for previous year (12 months)',
        source: 'Source',
        save_data: 'Save data'
    },
    qualitative_source: {
      select_level:'Select level',
      observations_by_source: 'Observations by source by criteria',
      observations_by_level: 'Observations by level',
      possible_problems: 'Possible problems by criteria'
    },
    observationsByAmbit:{
      tittle: 'Observations by level',
      decision: 'Decision',
      save_data: 'Save data'

    },
    problematicByCriterion:{
      title: 'Possible problems by criteria',
      save_data: 'Save data'
    },
    users: {
        title: 'Users administration',
        add_new: 'Add user',
        update: "Update user's information",
        name: 'Name',
        email: 'Email',
        type: 'Role',
        registered_at: 'Registered at',
        status: 'Status',
        last_login_at: 'Last connection',
        edit : 'Edit',
        see : 'View',
        act_des : 'Activate / Desactivate',
        delete : 'Delete',
        domain : 'Domain',
        select : 'Select domain',
        tipo : 'Type of user',
        description : 'Description',
        contrasena : 'Password',

    },
    sociodemographic: {
        add_new: 'Add Sociodemographic Context',
        update: 'Update Sociodemographic Context',
        title: 'Sociodemographic Context',
        select_state: 'Select a State',
        state: 'State',
        population: 'Population',
        population_rating: 'Population rating',
        surface: 'Surface (Km??)',
        surface_rating: 'Surface rating',
        density: 'Population density (population/Km??)',
        density_rating: 'Density rating',
        PIB: 'PIB (millions of pesos at current prices)',
        PIB_rating: 'PIB rating',
        PIB_percapita: 'PIB per capita (pesos at current prices)',
        PIB_percapita_rating: 'PIB per capita rating',
        school_average: 'Average schooling (years)',
        school_average_rating: 'Average schooling rating',
        lack_of_access_to_health: 'Percentage of population with lack of access to health services',
        lack_of_access_to_health_rating: 'Lack of access to health services rating',
        poverty: 'Poverty percentage',
        poverty_rating: 'Poverty rating',
        index_of_marginalization: 'Marginalization index',
        degree_of_marginalization: 'Degree of marginalization',
        index_of_marginalization_rating: 'Marginalization index rating',
    },
    other :{
      open_np : 'Open in new tab',
      open_nv : 'Open in new window'
    }
}

let es = {
    conclusion_criterion : 'Conclusi??n del criterio',
    hello: 'Hola',
    loading: 'Cargando...',
    downloading : 'Descargando...',
    create: 'Crear',
    update: 'Actualizar',
    close: 'Cerrar',
    custom_reports:{
      tittle: 'Reporte personalizado',
      select_state: 'Seleccionar estado',
      tittle_general_chart: 'Progreso general',
      general_reports: 'Reportes cargados',
      ejecutive: 'Reporte Ejecutivo',
      detailed: 'Reporte Detallado',
      documental: 'Fuente documental',
      all_documental: 'Toda la informaci??n organizacional',
      organization_chart: 'Organigrama',
      map: 'Mapa',
      cuantitative_source: 'Fuente cuantitativa',
      all_cuantitative_source: 'Todas las variables estad??sticas (por a??o)',
      cualitative_source: 'Fuente cualitativa',
      all_cualitative_source: 'Todos los ??mbitos de an??lisis',
      regulatory: '??mbito regulatorio',
      institutional: '??mbito institucional',
      individual: '??mbito individual',
      progress: 'de avance',
      reportEs: 'Espa??ol',
      reportEn: 'Ingl??s',
      button_report: 'Generar reporte personalizado'
    },
    observationsBySource: {
      tittle_min:'Observaciones por fuente por criterio',
      tittle_may: 'OBSERVACIONES POR FUENTE POR CRITERIO',
      criteria: 'Criterio',
      headquarters: 'Sede',
      source:'Fuente',
      observations: 'Observaciones',
      conclusion_save: 'Guardar conclusi??n',
      change_conclusion: 'Actualizar conclusi??n',
      conlusion_by_criteria: 'Conclusi??n por criterio',
      observation_save: 'Guardar observaci??n',
      update_observation:'Actualizar observaci??n'
    },
    observationsByAmbit:{
      tittle: 'Observaciones por ??mbito',
      decision: 'Decisi??n',
      save_data: 'Guardar datos'

    },
    profile:{
      users: 'Usuarios',
      profile: 'Perfil',
      activity: 'Actividad',
      settings: 'Ajustes',
      user_activity: 'Actividad del usuario',
      name: 'Nombre',
      description:'Descripci??n',
      picture: 'Foto de perfil',
      password: 'Contrase??a (Dejar vac??o si no hay cambios)',
      update: 'Actualizar'

    },
    problematicByCriterion:{
      title: 'Posibles problematicas por criterio',
      save_data: 'Guardar datos'
    },
    detailedReport:{
      title:'Reporte Detallado',
      generate_pdf:'Generar PDF',
      generate_docx: 'Generar Docx',
      socio_demographic_data: 'Informaci??n Sociodemogr??fica',
      state_information: 'Informaci??n del estado',
      nacional_average: 'Promedio nacional',
      ranking: 'Clasificaci??n estatal a nivel nacional',
      crime_data: 'Informaci??n De Criminalidad',
      state_map: 'Mapa Del Estado',
      map_includes: 'Mapa del estado que incluye:',
      AGO_Headquarters: 'Sedes de la Fiscal??a/Procuradur??a',
      municipalities_ago: 'Municipios dentro de las sedes de la Fiscal??a/Procuradur??a',
      number_per_region: 'N??mero de Agentes del Ministerio P??blico por sede',
      AGO_Headquarters_offices: 'Sede de la fiscal??a / procuradur??a',
      municipalities_by_headquartes: 'Municipios por sede',
      organizational_structure: 'Estructura Organizacional',
      organizational_chart: 'Organigrama',
      organizational_chart_institution: 'Organigrama de la instituci??n estructurado a nivel de detalle que permite conocer la composici??n de las unidades de investigaci??n.',

      level: '??mbito',
      conclusion_by_level: 'Conclusi??n por ??mbito',
      possible_problem: 'Posibles Problem??ticas',
      regulatory: 'Regulatorio',
      institutional: 'Institucional',
      individual: 'Individual',




    },
    executiveReport:{
      title: 'Reporte Ejecutivo',
      regulatory_level: '??mbito Regulatorio',
      institutional_level: '??mbito Institucional',
      individual_level: '??mbito Individual',
      criteria: 'Criterio',
      possible_problem:'Posible problem??tica',
      generate_pdf:'Generar PDF',
      generate_docx: 'Generar Docx'
    },
    repository:{
      title: 'Repositorio de informaci??n',
      zip: 'Descargar Zip',
      add_document: 'Agregar documento',
      documents_from: 'Documentos de',
      name: 'Nombre',
      type:'Tipo',
      date: 'Fecha de creaci??n',
      dowload: 'Descargar',
      delete: 'Eliminar',
      document: 'Documento',
      add: 'Agregar',
      cancel: 'Cancelar'


    },
    breadcrumb: {
      home: 'Inicio',
      state: 'Estados',
      round: 'Ronda',
      documentary_information: 'Informaci??n documental',
      users: 'Usuarios',
      sociodemographic: 'Contexto Sociodemogr??fico',
      quantitative_sources: 'Fuentes Cuantitativas',
      qualitative_sources: 'Fuentes Cualitativas',
    },
    states: {
      select_state: 'Selecciona el estado',
      custom_report_button: 'Tablero de progreso y generaci??n de reportes personalizados'
    },
    state: {
      title: 'Carga de informaci??n',
      complete_task: ' Tarea completa',
      in_process_task: 'Tarea en proceso',
      pending_task: 'Tarea pendiente',
      documentary_information: 'Fuente documental',
      quantitative_sources: 'Fuentes Cuantitativas',
      qualitative_sources: 'Fuentes Cualitativas',
      indicator_year : 'Indicadores por a??o',

      final_reports_title: 'Reportes finales',
      final_reports_spanish: 'Reportes finales espa??ol',
      final_reports_english: 'Reportes finales ingl??s',
      executive_report: 'Reporte Ejecutivo',
      detailed_report: 'Reporte Detallado',
      dowload_report: 'Descargar reporte',
      change_report: 'Actualizar reporte',
      add_executive_report: 'Agregar reporte Ejecutivo',
      add_detailed_report: 'Agregar reporte Detallado',
      document_uploaded: 'A??n no se ha cargado el documento',
      read_detailed: 'Revisi??n de reporte Detallado',
      read_executive: 'Revisi??n de reporte Ejecutivo',
      other_documents: 'OTROS DOCUMENTOS ??TILES DEL ESTADO',
      document_repository: 'Repositorio de documentos',
      spreadsheet:'Hoja de c??lculo',
      load_data: 'Cargar datos',
      cacel: 'Cancelar',
      name: 'Nombre',
      document_type:'Tipo de documento',
      document: 'Documento',
      add: 'Agregar',




    },
    documental_repository: {
      title: 'Informaci??n ??til',
      table_disaster: 'Plan de recuperaci??n de desastres',
      name: 'Nombre',
      type: 'Tipo',
      date: 'Fecha de creaci??n',
      dowload: 'Descargar',
      delete: 'Eliminar',
      add: 'Agregar documento',
      forms: 'Formatos',
      document: 'Documento',
      add_button: 'Agregar',
      cancel: 'Cancelar'


    },
    documentary_information: {
      title: 'Informaci??n documental',
      organization_chart: 'Organigrama',
      map: 'Mapa',
      headquarter: 'Sedes evaluadas',

      map_include: 'El mapa debe incluir:',
      headquarter_offices: 'Sedes de la Fiscal??a/Procuradur??a',
      headquarter_offices_regions: 'Municipios dentro de las sedes de la Fiscal??a/Procuradur??a',
      number_prosecutors: 'N??mero de Agentes del Ministerio P??blico por sede',
      ago_region: 'Sede de la fiscal??a/ Procuradur??a',

      total_headquarter: 'Sedes totales',
      municipalities_seat: 'Municipios por sede',
      options : 'Sede evaluada',


    },
    quantitative_sources: {
      title: 'Datos cuantitativos: datos para indicadores',
      card_header: 'Captura de datos para indicadores',

      see_indicators_by_decision:'Ver indicadores por decisi??n',
      data_for_previus_year: 'Datos de los 12 meses del a??o anterior',
      source: 'Fuentes',
      save_data: 'Guardar datos'

    },
    qualitative_source: {
      select_level:'Seleccionar ??mbito',
      observations_by_source: 'Observaciones por Fuente por Criterio',
      observations_by_level: 'Observaciones por ??mbito',
      possible_problems: 'Posibles problem??ticas por Criterio'
    },
    users: {
      title: 'Administraci??n de usuarios',
      add_new: 'Agregar usuario',
      update: 'Actualizar informaci??n del usuario',
      name: 'Nombre',
      email: 'Correo electr??nico',
      type: 'Rol',
      registered_at: 'Fecha de registro',
      status: 'Estatus',
      last_login_at: '??ltima conexi??n',
      edit : 'Editar',
      see : 'Ver',
      act_des : 'Activar / Desactivar',
      delete : 'Eliminar',
      domain : 'Dominio',
      select : 'Seleccionar dominio',
      tipo : 'Tipo de usuario',
      description : 'Descripci??n',
      contrasena : 'Contrase??a',
    },
    sociodemographic: {
      add_new: 'Agregar contexto sociodemogr??fico',
      update: 'Actualizar contexto sociodemogr??fico',
      title: 'Contexto Sociodemogr??fico',
      select_state: 'Selecciona un Estado',
      state: 'Estado',
      population: 'Poblaci??n (habitantes)',
      population_rating: 'Clasificaci??n de poblaci??n',
      surface: 'Superficie (Km??)',
      surface_rating: 'Clasificaci??n de superficie',
      density: 'Densidad de poblaci??n (habitantes/Km??)',
      density_rating: 'Clasificaci??n de densidad',
      PIB: 'PIB (millones de pesos a precios corrientes)',
      PIB_rating: 'Clasificaci??n de PIB',
      PIB_percapita: 'PIB per-c??pita (pesos a precios corrientes)',
      PIB_percapita_rating: 'Clasificaci??n de PIB per-c??pita',
      school_average: 'Promedio de escolaridad (a??os)',
      school_average_rating: 'Clasificaci??n de promedio de escolaridad',
      lack_of_access_to_health: 'Porcentaje de poblaci??n con carencia por acceso a servicios de salud',
      lack_of_access_to_health_rating: 'Clasificaci??n de carencia por acceso a servicios de salud',
      poverty: 'Porcentaje de pobreza',
      poverty_rating: 'Clasificaci??n de pobreza',
      index_of_marginalization: '??ndice de marginaci??n',
      degree_of_marginalization: 'Grado de marginaci??n',
      index_of_marginalization_rating: 'Clasificaci??n de ??ndice de marginaci??n',
    },

    other :{
      open_np : 'Abrir nueva pesta??a',
      open_nv : 'Abrir nueva ventana'
    }

}

const i18n = new VueI18n({
    locale: 'es',
    fallbackLocale: 'en',
    messages: {
        en,
        es
    }
})

export default i18n
