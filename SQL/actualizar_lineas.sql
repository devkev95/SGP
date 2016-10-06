DELIMITER $$


DROP PROCEDURE IF EXISTS `sgp_system`.`actualizar_lineas`$$


CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    PROCEDURE `sgp_system`.`actualizar_lineas`()
BEGIN       
    UPDATE linearecurso SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;
    
    UPDATE lineamanoobra SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;
    
    UPDATE lineaequipoherramienta SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;
    
    UPDATE lineasubcontrato SET numero=(SELECT numero FROM partida ORDER BY numero DESC LIMIT 1)
	WHERE numero=0;
END
DELIMITER ;