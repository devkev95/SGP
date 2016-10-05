BEGIN   
    DECLARE total_materiales DOUBLE DEFAULT 0.0;
    DECLARE total_manoobra DOUBLE DEFAULT 0.0;
    DECLARE total_equipoherramientas DOUBLE DEFAULT 0.0;
    DECLARE total_subcontratos DOUBLE DEFAULT 0.0;

    DECLARE cd DOUBLE DEFAULT 0.0;
    DECLARE ci DOUBLE DEFAULT 0.0;
    DECLARE pu DOUBLE DEFAULT 0.0;

    SELECT SUM(subTotal) INTO total_materiales FROM linearecurso WHERE numero=p_numero;
    SELECT SUM(subTotal) INTO total_manoobra FROM lineamanoobra WHERE numero=p_numero;
    SELECT SUM(subTotal) INTO total_equipoherramientas FROM lineaequipoherramienta WHERE numero=p_numero;
    SELECT SUM(subTotal) INTO total_subcontratos FROM lineasubcontrato WHERE numero=p_numero;
    SET cd=total_materiales+total_manoobra+total_equipoherramientas+total_subcontratos;
    SET ci=cd*0.29;
    SET pu=cd+ci;

    INSERT INTO partida (numero, nombre, totalCD, totalCI, precioUnitario, totalMateriales. totalManoObra, totalEquipoHerramientas, totalSubContratos)
    VALUES (NULL, p_nombre, cd, ci, pu, total_materiales, total_manoobra, total_equipoherramientas, total_subcontratos);
END

    DECLARE total_materiales DOUBLE DEFAULT 0.0;
    DECLARE total_manoobra DOUBLE DEFAULT 0.0;
    DECLARE total_equipoherramientas DOUBLE DEFAULT 0.0;
    DECLARE total_subcontratos DOUBLE DEFAULT 0.0;

    DECLARE cd DOUBLE DEFAULT 0.0;
    DECLARE ci DOUBLE DEFAULT 0.0;
    DECLARE pu DOUBLE DEFAULT 0.0;

    SELECT SUM(subTotal) INTO total_materiales FROM linearecurso WHERE numero=0;
    SELECT SUM(subTotal) INTO total_manoobra FROM lineamanoobra WHERE numero=0;
    SELECT SUM(subTotal) INTO total_equipoherramientas FROM lineaequipoherramienta WHERE numero=0;
    SELECT SUM(subTotal) INTO total_subcontratos FROM lineasubcontrato WHERE numero=0;
    SET cd=total_materiales+total_manoobra+total_equipoherramientas+total_subcontratos;
    SET ci=cd*0.29;
    SET pu=cd+ci;

    INSERT INTO partida (numero, nombre, totalCD, totalCI, precioUnitario, totalMateriales. totalManoObra, totalEquipoHerramientas, totalSubContratos)
    VALUES (NULL,p_nombre, cd, ci, pu, total_materiales, total_manoobra, total_equipoherramientas, total_subcontratos);

    UPDATE linearecurso SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;
    
    UPDATE lineamanoobra SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;
    
    UPDATE lineaequipoherramienta SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;
    
    UPDATE lineasubcontrato SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;