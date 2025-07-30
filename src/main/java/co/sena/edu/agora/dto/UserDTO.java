package co.sena.edu.agora.dto;

import lombok.Data;

@Data
public class UserDTO {
    private Long id;
    private PersonDTO person;
    private String username;
    private Boolean isActive;
    private RoleDTO role;
}
